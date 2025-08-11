<?php
// Admin/Jobs/admin_jobs.php
session_name('ADMINSESSID');
session_start();
ob_start();
// DB connection (adjust path to your PDO)
include '../database/db_connection.php'; // expects $pdo

// Upload folders (ensure writable)
$imgFolder  = __DIR__ . '/../../Job page images/'; // goes up from Admin/Jobs -> project root -> Job page images folder
$imgWebPath = '';               // URL relative from Admin/Jobs/list.php -> ../Job page images/



if (!is_dir($imgFolder)) mkdir($imgFolder, 0755, true);


$error = '';
$success = '';

// Helper: normalize job_type to enum values
function normalizeJobType($raw) {
    $s = trim(strtolower((string)$raw));
    if (strpos($s, 'full') !== false) return 'Full Time';
    if (strpos($s, 'part') !== false) return 'Part Time';
    return 'Full Time';
}

// ---------- Handle create (simple, no CSRF) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_title   = trim($_POST['job_title'] ?? '');
    $description = trim($_POST['description'] ?? null);
    $requirement = trim($_POST['requirement'] ?? null);
    $location    = trim($_POST['location'] ?? null);
    $job_type    = normalizeJobType($_POST['job_type'] ?? '');
    $org_name    = trim($_POST['org_name'] ?? '');
    $job_attachment_input = trim($_POST['job_attachment'] ?? ''); // user can paste link directly
    $imglogo_input = trim($_POST['imglogo_url_text'] ?? ''); // allow direct filename/url text if preferred

    if ($job_title === '') {
        $error = 'Job title is required.';
    } else {
        $attachPathForDb = null;
        $logoPathForDb   = null;

        // attachment: prefer pasted link (form) or uploaded file (if you later add a file input)
        if ($job_attachment_input !== '') {
            $attachPathForDb = $job_attachment_input;
        }

        // logo upload (optional)
        if (!empty($_FILES['imglogo_file']) && $_FILES['imglogo_file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $f = $_FILES['imglogo_file'];
            if ($f['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                $allowedImg = ['jpg','jpeg','png','gif','webp'];
                if (!in_array($ext, $allowedImg)) $error = 'Logo must be an image (jpg/png/gif/webp).';
                elseif ($f['size'] > 2 * 1024 * 1024) $error = 'Logo must be < 2MB.';
                else {
                    $safe = bin2hex(random_bytes(8)) . '.' . $ext;
                    $dest = $imgFolder . $safe;
                    if (move_uploaded_file($f['tmp_name'], $dest)) {
                        $logoPathForDb = $imgWebPath . $safe;
                    } else $error = 'Failed to move logo file.';
                }
            } else $error = 'Logo upload error.';
        } elseif ($imglogo_input !== '') {
            $logoPathForDb = $imglogo_input;
        }

        // insert (no posted_date)
        if (!$error) {
            $sql = "INSERT INTO job_tbl (org_name, job_title, job_type, location, description, requirement, job_attachment, imglogo_url)
                    VALUES (:org_name, :job_title, :job_type, :location, :description, :requirement, :job_attachment, :imglogo_url)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':org_name'      => $org_name ?: null,
                ':job_title'     => $job_title,
                ':job_type'      => $job_type,
                ':location'      => $location ?: null,
                ':description'   => $description ?: null,
                ':requirement'   => $requirement ?: null,
                ':job_attachment'=> $attachPathForDb ?: null,
                ':imglogo_url'   => $logoPathForDb ?: null,
            ]);
            $success = 'Job created successfully.';
            // reset variables
            $job_title = $description = $requirement = $location = $job_type = $org_name = $job_attachment_input = $imglogo_input = '';
        }
    }
}

// ---------- Fetch jobs for listing (no posted_date sort) ----------
$stmt = $pdo->query("SELECT * FROM job_tbl ORDER BY job_id DESC");
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php ob_start(); ?>
 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Counsellor List</h1>
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body shadow">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-2">
              <label class="form-label">Organization</label>
              <input name="org_name" class="form-control" value="<?= htmlspecialchars($org_name ?? '') ?>">
            </div>
            <div class="mb-2">
              <label class="form-label">Job Title *</label>
              <input name="job_title" class="form-control" value="<?= htmlspecialchars($job_title ?? '') ?>" required>
            </div>

            <div class="mb-2">
              <label class="form-label">Job Type *</label>
              <input name="job_type" class="form-control" placeholder="Full Time / Part Time" value="<?= htmlspecialchars($job_type ?? '') ?>" required>
            </div>

            <div class="mb-2">
              <label class="form-label">Location</label>
              <input name="location" class="form-control" value="<?= htmlspecialchars($location ?? '') ?>">
            </div>



            <div class="mb-2">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($description ?? '') ?></textarea>
            </div>

            <div class="mb-2">
              <label class="form-label">Requirement</label>
              <textarea name="requirement" class="form-control" rows="2"><?= htmlspecialchars($requirement ?? '') ?></textarea>
            </div>

            <hr>
            <div class="mb-2">
              <label class="form-label">Job Attachment Link </label>
              <input type="url" name="job_attachment" class="form-control" placeholder="https://example.com/job/123" value="<?= htmlspecialchars($job_attachment_input ?? '') ?>">
            </div>
             <div class="mb-3">
                                          <label>Logo</label>
                                          <input type="file" name="imglogo_file" accept="image/*" class="form-control">
                                        </div>

            <button type="submit" name="create"  class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>

    <!-- List -->
   <div class="col">
  <div class="table-responsive">
    <table class="table table-hover shadow-sm">
      <thead class="bg-primary text-white">
        <tr>
          <th></th>              <!-- toggle column (chevron) -->
          <th>Id</th>
          <th>Title</th>
          <th>description</th>
          <th>requirement</th>
          <th>location</th>

          <th></th>              <!-- actions -->
        </tr>
      </thead>
      <tbody>
        <?php foreach ($jobs as $j): ?>
          <tr class="main-row" data-id="<?= (int)$j['job_id'] ?>">
            <td class="toggle-cell" style="cursor:pointer; width:34px; text-align:center;">
              <i class="fas fa-chevron-right"></i>
            </td>

            <td><?= (int)$j['job_id'] ?></td>
            <td><?= htmlspecialchars($j['job_title']) ?></td>
            <td><?= nl2br(htmlspecialchars($j['description'] ?? '')) ?></td>
            <td><?= nl2br(htmlspecialchars($j['requirement'] ?? '')) ?></td>
            <td><?= htmlspecialchars($j['location']) ?></td>


            <td>
             <a href="edit.php?job_id=<?= $j['job_id'] ?>" class="btn btn-sm btn-secondary">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= (int)$j['job_id'] ?>)">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>

          <!-- detail row (hidden by default) -->
          <tr id="detail-<?= (int)$j['job_id'] ?>" class="detail-row" style="display:none; background:#f8f9fa;">
            <td colspan="8" class="bg-light">
                  <strong>Job Type:</strong><?= htmlspecialchars($j['job_type'] ?? '') ?><br>
                  <strong>Organization:</strong><?= htmlspecialchars($j['org_name'] ?? '') ?><br>
                  <strong>Attachment:</strong>
               
                      <?php if (!empty($j['job_attachment'])): ?>
                        <a href="<?= htmlspecialchars($j['job_attachment']) ?>" target="_blank" class="text-decoration-none">
                          <?= htmlspecialchars($j['job_attachment']) ?>
                        </a>
                      <?php else: ?>
                        <span class="text-muted">—</span>
                      <?php endif; ?><br>
                  
                 

                  <strong>Logo:</strong>

                           <?php if ($j['imglogo_url']): ?>
                                    <img src="<?= '../../Job page images/' . htmlspecialchars($j['imglogo_url']) ?>" alt="Job Image" style="width: 80px; height: auto;">
                                <?php else: ?>
                             -
                                <?php endif; ?>
              
            </td>
          </tr>

        <?php endforeach; ?>
      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
    $content = ob_get_clean();
    require '../layouts/master.php';
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "This will permanently delete the record and cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "Cancel"
  }).then(result => {
    if (result.isConfirmed) {
      // irreversible: redirect to your delete script
      window.location.href = 'delete.php?id=' + id;
    }
  });
}

// show success/error alerts on page load
document.addEventListener('DOMContentLoaded', () => {
  <?php if (!empty($success)): ?>
    Swal.fire({ icon: 'success', title: 'Success', text: <?= json_encode($success) ?>, timer: 1800, showConfirmButton:false });
  <?php elseif (!empty($error)): ?>
    Swal.fire({ icon: 'error', title: 'Error', text: <?= json_encode($error) ?>, confirmButtonText: 'OK' });
  <?php endif; ?>
});
</script>
<script>
// after the table, add:
document.querySelectorAll('.toggle-cell').forEach(cell => {
  cell.addEventListener('click', () => {
    const tr = cell.closest('tr.main-row');
    const id = tr.dataset.id;
    const detail = document.getElementById('detail-' + id);
    const icon   = cell.querySelector('i');

    if (detail.style.display === 'none') {
      detail.style.display = '';
      icon.classList.replace('fa-chevron-right', 'fa-chevron-down');
    } else {
      detail.style.display = 'none';
      icon.classList.replace('fa-chevron-down', 'fa-chevron-right');
    }
  });
});
</script>
    