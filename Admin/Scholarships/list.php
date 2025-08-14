<?php
    // Admin/Scholarship/list.php
session_name('ADMINSESSID');
session_start();
    include '../database/db_connection.php';

    // ── 1) Handle Create (PRG) ──
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
        // sanitize inputs
        $title        = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $country      = trim($_POST['country'] ?? '');
        $intake       = trim($_POST['intake_season'] ?? '');
        $degree_level = trim($_POST['degree_level'] ?? '');
        $type         = trim($_POST['type'] ?? '');
        $deadline     = trim($_POST['deadline'] ?? '');
        $coverage    = trim($_POST['coverage']    ?? '');
        $apply_link  = trim($_POST['apply_link']  ?? '');
        $eligibility = trim($_POST['eligibility'] ?? '');
        // handle logo upload
        $logoFilename = null;
        if (! empty($_FILES['image']['name'])) {
            $uploadDir = __DIR__ . '/../../Scholarships_page_images/';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $tmp     = $_FILES['image']['tmp_name'];
            $orig    = basename($_FILES['image']['name']);
            $ext     = pathinfo($orig, PATHINFO_EXTENSION);
            $newName = uniqid('logo_', true) . '.' . $ext;
            $target  = $uploadDir . $newName;

            if (move_uploaded_file($tmp, $target)) {
                $logoFilename = $newName;
            } else {
                $_SESSION['flash_error'] = "Failed to upload logo.";
                header("Location: list.php");
                exit;
            }
        }

        // basic validation
        if ($title === '' || $country === '' || $intake === '') {
            $_SESSION['flash_error'] = "Title, Country, and Intake are required.";
        } else {
           $ins = $conn->prepare("
            INSERT INTO Scholarship_tbl
              (title, description, logo_url, coverage, country,
              apply_link, deadline, intake_season, degree_level, `type`, eligibility)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          ");
          $ins->bind_param(
            "sssssssssss",
            $title,
            $description,
            $logoFilename,
            $coverage,
            $country,
            $apply_link,
            $deadline,
            $intake,
            $degree_level,
            $type,
            $eligibility
          );

            if ($ins->execute()) {
                $_SESSION['flash_success'] = "Scholarship “{$title}” created.";
            } else {
                $_SESSION['flash_error'] = "Insert failed: " . $ins->error;
            }
            $ins->close();
        }

        // redirect so the browser does a GET
        header("Location: list.php");
        exit;
    }

    // ── 2) Read flash messages ──
    $success = $_SESSION['flash_success'] ?? '';
    $error   = $_SESSION['flash_error'] ?? '';
    unset($_SESSION['flash_success'], $_SESSION['flash_error']);

    // ── 3) Pagination setup ──
    $limit      = 5;
    $page       = max(1, (int) ($_GET['page'] ?? 1));
    $offset     = ($page - 1) * $limit;
    $totalRes   = $conn->query("SELECT COUNT(*) AS cnt FROM Scholarship_tbl");
    $total      = $totalRes->fetch_assoc()['cnt'];
    $totalPages = (int) ceil($total / $limit);

    // ── 4) Fetch current page ──
    $stmt = $conn->prepare("
    SELECT
      scholarship_id,
      title,
      description,
      logo_url,
      country,
      intake_season,
      degree_level,
      `type`,
      deadline,
      coverage,
      apply_link,
      eligibility
    FROM Scholarship_tbl
    ORDER BY scholarship_id DESC
    LIMIT ? OFFSET ?
");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $list = $stmt->get_result();
    $stmt->close();
?>

<?php ob_start(); ?>
<style>
      /* keep the two columns side-by-side always */
      .no-wrap-row { display: flex; flex-wrap: nowrap; gap: 1rem; align-items: flex-start; }
      .form-col { flex: 0 0 360px; max-width: 440px; min-width: 260px; }
      .table-col { flex: 1 1 0; min-width: 0; }
      .table-col .table-responsive { overflow-x: auto; }
      .card.form-card { height: 100%; }
      .table thead th { white-space: nowrap; }
      .rotate { transition: transform .18s ease-in-out; }
      .rotate.open { transform: rotate(90deg); }
      /* Make small tweak so collapse content inside td has some spacing */
      .detail-inner { padding: 1rem; }
      .detail-row { display: none; }
.detail-row .detail-cell { padding: .75rem 1rem; background: #f8f9fa; }
.toggle-btn { width: 34px; height: 34px; padding: 6px; }

    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid py-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Scholarship List</h1>
                    </div>

                  
                        <div class="no-wrap-row">
                                                  <!-- LEFT: Create form -->
                          <div class="form-col">
                            <div class="card form-card shadow-sm">
                              <div class="card-body p-3">
                                      <form method="post" action="list.php" enctype="multipart/form-data">
                                        <div class="mb-2">
                                          <input type="text" name="title" class="form-control" placeholder="Title" required>
                                        </div>
                                        <div class="mb-2">
                                          <input type="text" name="description" rows="2" class="form-control" placeholder="Description..." required>
                                        </div>
                                        <div class="mb-2">
                                          <input type="text" name="country" class="form-control" placeholder="Country..." required>
                                        </div>
                                        <div class="mb-2">
                                          <input type="text" name="intake_season" class="form-control" placeholder="Intake Season..." required>
                                        </div>
                                        <div class="mb-2">
                                          <input type="text" name="degree_level" class="form-control" placeholder="Degree Level...">
                                        </div>
                                        <div class="mb-2">
                                          <input type="text" name="type" class="form-control" placeholder="Type...">
                                        </div>
                                        <div class="mb-2">
                                          <input type="text" name="deadline" class="form-control" placeholder="Deadline...">
                                        </div>
                                        <div class="mb-3">
                                          <textarea name="coverage"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Coverage (brief description)..."></textarea>
                                        </div>
                                        <div class="mb-3">
                                          <input type="url" name="apply_link" class="form-control"
                                                placeholder="Apply link (https://...)">
                                        </div>
                                        <div class="mb-3">
                                          <textarea name="eligibility"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Eligibility criteria"></textarea>
                                        </div>
                                        <div class="mb-3">
                                          <label>Logo</label>
                                          <input type="file" name="image" accept="image/*" class="form-control">
                                        </div>
                                        <button type="submit" name="create" class="btn btn-primary w-100">Create</button>
                                      </form>


                                    </div>
                                </div>
                            </div>
  <!-- RIGHT: Table -->
        <div class="table-col">
          <div class="card shadow-sm">
            <div class="card-body p-0">

              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead class="bg-primary text-white">
                      <tr>
                        <th style="width:40px"></th>               <!-- for the toggle button -->
                        <th>ID</th>
                        <th>Title</th>
                        <th>Country</th>
                        <th>Intake</th>
                        <th>Degree</th>
                        <th>Type</th>
                        <th style="width:120px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($r = $list->fetch_assoc()): ?>
                <tr class="main-row" data-id="<?= $r['scholarship_id'] ?>">
                       <td class="text-center align-middle">
                        <button type="button" class="btn btn-sm btn-outline-secondary toggle-btn" aria-expanded="false" title="Show details">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </td>
                        <td><?= $r['scholarship_id'] ?></td>
                        <td><?= htmlspecialchars($r['title']) ?></td>
                        <td><?= htmlspecialchars($r['country']) ?></td>
                        <td><?= htmlspecialchars($r['intake_season']) ?></td>
                        <td><?= htmlspecialchars($r['degree_level']) ?></td>
                        <td><?= htmlspecialchars($r['type']) ?></td>
                        <td>
                          <a href="edit.php?id=<?= $r['scholarship_id'] ?>"
                            class="btn btn-sm btn-light"><i class="fa-solid fa-pen-to-square"></i></a>
                          <button class="btn btn-sm btn-danger"
                                  onclick="confirmDelete(<?= $r['scholarship_id'] ?>)">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <tr class="detail-row" id="detail-<?= $r['scholarship_id'] ?>" style="display:none; background:#f8f9fa;">
                          <td colspan="8" class="bg-light">
                              <div class="detail-inner bg-light border-top">
                            <strong>Description:</strong>
                          <?= isset($r['description']) ? nl2br(htmlspecialchars($r['description'])) : '' ?><br>
                            <strong>Deadline:</strong> <?= htmlspecialchars($r['deadline']) ?><br>
                            <strong>Coverage:</strong> <?= nl2br(htmlspecialchars($r['coverage'])) ?><br>
                            <strong>Apply Link:</strong>
                              <?php if ($r['apply_link']): ?>
                                <a href="<?= htmlspecialchars($r['apply_link']) ?>" target="_blank">Link</a>
                              <?php endif; ?><br>
                            <strong>Eligibility:</strong> <?= nl2br(htmlspecialchars($r['eligibility'])) ?><br>
                            <strong>Logo:</strong>

                           <?php if ($r['logo_url']): ?>
                                    <img src="<?= '../../Scholarships_page_images/' . htmlspecialchars($r['logo_url']) ?>" alt="Job Image" style="width: 80px; height: auto;">
                                <?php else: ?>
                             -
                                <?php endif; ?>
                                  </div>
          </td>
        </tr>
      <?php endwhile; ?>  
    </tbody>
  </table>
</div>

          </div> <!-- /.card -->
        </div> <!-- /.table-col -->

      </div> <!-- /.no-wrap-row -->

    </div> <!-- /.container-fluid -->

    <!-- pagination -->
             <nav>
                                    <ul class="pagination justify-content-end">
                                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                        <li class="page-item <?php echo $p === $page ? 'active' : ''?>">
                                        <a class="page-link" href="?page=<?php echo $p?>"><?php echo $p?></a>
                                        </li>
                                    <?php endfor; ?>
                                    </ul>
                                </nav>
    </div>


                                </div>
                            </div>
                            </div>

<?php
    $content = ob_get_clean();
    require '../layouts/master.php';
?>
<!-- SweetAlert2 + delete script -->
<script>
function confirmDelete(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "This will permanently delete the scholarship!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "Cancel"
  }).then(result => {
    if (result.isConfirmed) {
      window.location.href = 'delete.php?id=' + id;
    }
  });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($success): ?>
    Swal.fire({
      icon: 'success',
      title: 'Created!',
      text: <?php echo json_encode($success)?>,
      timer: 2000,
      showConfirmButton: false
    });
  <?php elseif ($error): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: <?php echo json_encode($error)?>,
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
});
</script>
<script>
// after the table, add:
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            // main row is the button's closest tr
            const mainRow = btn.closest('tr');
            // detail row is the next tr sibling
            const detailRow = mainRow.nextElementSibling;
            if (!detailRow || !detailRow.classList.contains('detail-row')) return;

            const expanded = btn.getAttribute('aria-expanded') === 'true';

            if (expanded) {
                // hide
                detailRow.style.display = 'none';
                btn.setAttribute('aria-expanded', 'false');
                // swap icon to right
                btn.querySelector('i').classList.remove('fa-chevron-down');
                btn.querySelector('i').classList.add('fa-chevron-right');
                detailRow.setAttribute('aria-hidden', 'true');
            } else {
                // show
                detailRow.style.display = 'table-row';
                btn.setAttribute('aria-expanded', 'true');
                // swap icon to down
                btn.querySelector('i').classList.remove('fa-chevron-right');
                btn.querySelector('i').classList.add('fa-chevron-down');
                detailRow.setAttribute('aria-hidden', 'false');
            }
        });
    });
});
</script>