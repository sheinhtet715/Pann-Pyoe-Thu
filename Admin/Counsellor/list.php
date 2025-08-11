
    <?php
session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php';
$page = max(1, (int)($_GET['page'] ?? 1));
// ── 1) Handle Create (with file upload) ──
if (isset($_POST['create'])) {
    // sanitize text inputs
    $name    = trim($_POST['counsellor_name']   ?? '');
    $degree  = trim($_POST['degree']             ?? '');
    $spec    = trim($_POST['specialization']     ?? '');
    $phone   = trim($_POST['phone']              ?? '');
    $email   = trim($_POST['email']              ?? '');
    $exp     = trim($_POST['experiences']        ?? '');

    // handle file upload
  // … above: after you trim $_POST fields …

// Handle file upload from <input name="image">
// 1) Build the upload directory path:
$uploadDir = __DIR__ . '/../../Counsellor_page_images/';
if (! is_dir($uploadDir) && ! mkdir($uploadDir, 0755, true)) {
    die("Failed to create upload directory: {$uploadDir}");
}

// 2) Check for the uploaded file under $_FILES['image']
$imgFilename = null;
if (! empty($_FILES['image']['name'])) {
    $tmp     = $_FILES['image']['tmp_name'];
    $orig    = basename($_FILES['image']['name']);
    $ext     = pathinfo($orig, PATHINFO_EXTENSION);
    $newName = uniqid('img_', true) . '.' . $ext;
    $target  = $uploadDir . $newName;

    if (move_uploaded_file($tmp, $target)) {
        $imgFilename = $newName;
    } else {
        $error = "❌ Failed to move uploaded file to: {$target}";
    }
}

    // validation
    if (empty($name) || empty($degree) || empty($spec)) {
        $error = "Name, Degree and Specialization are required.";
    }

    // insert if no errors
    if (empty($error)) {
       $ins = $conn->prepare("
            INSERT INTO Counsellor_tbl
            (counsellor_name, degree, specialization,
            phone, email, experiences, image_url)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $ins->bind_param(
            "sssssss",
            $name, $degree, $spec,
            $phone, $email, $exp,
            $imgFilename   // <-- just the filename
        );
        if ($ins->execute()) {
        $_SESSION['flash_success'] = "Counsellor “{$name}” created successfully!";
        } else {
            $_SESSION['flash_error'] = "Insert failed: " . $ins->error;
        }
        $ins->close();

    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?page={$page}");
    exit;

}
    $success = $_SESSION['flash_success'] ?? '';
    $error   = $_SESSION['flash_error']   ?? '';
    unset($_SESSION['flash_success'], $_SESSION['flash_error']);


// ── 2) Pagination + fetch ──
$limit      = 5;
$page       = max(1, (int)($_GET['page'] ?? 1));
$offset     = ($page - 1) * $limit;

$totalRes   = $conn->query("SELECT COUNT(*) AS cnt FROM Counsellor_tbl");
$total      = $totalRes->fetch_assoc()['cnt'];
$totalPages = (int)ceil($total / $limit);

$stmt = $conn->prepare("
    SELECT counsellor_id,
           counsellor_name,
           degree,
           specialization,
           email,
           phone,
           experiences,
           image_url
      FROM Counsellor_tbl
     ORDER BY counsellor_id DESC
     LIMIT ? OFFSET ?
");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$list = $stmt->get_result();
$stmt->close();
?>

<?php
    ob_start();
    ?>
      <style>
      /* keep the two columns side-by-side always (no wrapping) and allow scrolling when needed */
      .no-wrap-row { display: flex; flex-wrap: nowrap; gap: 1rem; }

      /* left column (form) fixed/min width but allowed to shrink slightly */
      .form-col { flex: 0 0 360px; max-width: 420px; min-width: 280px; }

      /* right column grows and can scroll horizontally if table is wider */
      .table-col { flex: 1 1 0; min-width: 0; }

      /* make the table area scroll horizontally instead of wrapping under the form */
      .table-col .table-responsive { overflow-x: auto; }

      /* visual niceties */
      .card.form-card { height: 100%; }
      .table thead th { white-space: nowrap; }

      /* tiny helper for chevron rotation when collapse is shown */
      .rotate { transition: transform .2s ease-in-out; }
      .rotate.open { transform: rotate(90deg); }
    </style>
                <!-- Begin Page Content -->
                    <div class="container-fluid py-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Counsellor List</h1>
                    </div>
 <div class="no-wrap-row">
                      <div class="form-col">
          <div class="card form-card shadow-sm">
            <div class="card-body p-3">
                                    <div class="card-body shadow">
                                        <form action="" method="post" class="p-3 rounded" enctype="multipart/form-data">
                                             <div class="mb-2">
                                            <input type="text" name="counsellor_name"   class="form-control mb-3" placeholder="Name..." required>

                                            </div>
                                              <div class="mb-2">
                                            <input type="text" name="degree"             class="form-control mb-3" placeholder="Degree..." required>

                                            </div>
                                              <div class="mb-2">
                                            <input type="text" name="specialization"     class="form-control mb-3" placeholder="Specialization..." required>

                                            </div>
                                              <div class="mb-2">
                                            <input type="text" name="phone"              class="form-control mb-3" placeholder="Phone...">

                                            </div>
                                              <div class="mb-2">
                                            <input type="email" name="email"             class="form-control mb-3" placeholder="Email...">

                                            </div>
                                              <div class="mb-2">
                                            <textarea    name="experiences"  class="form-control mb-3" placeholder="Experiences (semi-colon separated)"></textarea>

                                            </div>
                                              <div class="mb-2">
                                               <input type="file" name="image" id="" accept="image/*" class="form-control mt-1"onchange="loadFile(event)">

                                            </div>
                                             <div class="d-grid">
                                            <button type="submit" name="create" class="btn btn-outline-primary">Create</button>
                                            </div>
                                        </form>
</div>
                                    </div>
                                </div>
                            </div>

                                   <!-- RIGHT: Table (flexible, will scroll horizontally if needed) -->
        <div class="table-col">
          <div class="card shadow-sm">
            <div class="card-body p-0">

              <!-- Make table horizontally scrollable inside this column -->
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead class="bg-primary text-white">
            <tr>
              <th style="width:40px"></th> <!-- chevron column -->
              <th>ID</th>
              <th>Name</th>
              <th>Degree</th>
              <th>Specialization</th>
              <th>Email</th>
              <th style="width:120px">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $list->fetch_assoc()): 
              $id = (int)$row['counsellor_id'];
            ?>
              <tr class="main-row" data-id="<?= $id ?>">
                <td class="toggle-cell text-center align-middle">
                  <a class="text-decoration-none" data-bs-toggle="collapse" href="#detail-<?= $id ?>" role="button" aria-expanded="false" aria-controls="detail-<?= $id ?>">
                    <i class="fas fa-chevron-right"></i>
                  </a>
                </td>

                <td class="align-middle"><?= $id ?></td>
                <td class="align-middle"><?= htmlspecialchars($row['counsellor_name']) ?></td>
                <td class="align-middle"><?= htmlspecialchars($row['degree']) ?></td>
                <td class="align-middle"><?= htmlspecialchars($row['specialization']) ?></td>
                <td class="align-middle"><?= htmlspecialchars($row['email']) ?></td>

                <td class="align-middle">
                  <a href="edit.php?id=<?= $id ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  <button type="button" onclick="deleteCounsellor(<?= $id ?>)" class="btn btn-sm btn-outline-danger">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
              </tr>

              <!-- detail row (collapsed) -->
              <tr class="detail-row">
                <td colspan="7" class="p-0">
                  <div class="collapse" id="detail-<?= $id ?>">
                    <div class="p-3 bg-light border">
                      <div class="row">
                        <div class="col-md-4">
                          <strong>Phone</strong>
                          <div class="mt-1"><?= htmlspecialchars($row['phone'] ?: '—') ?></div>
                        </div>
                        <div class="col-md-5">
                          <strong>Experiences</strong>
                          <ul class="mt-1">
                            <?php
                              $exps = array_filter(array_map('trim', explode(';', $row['experiences'] ?? '')));
                              if (count($exps) === 0) {
                                echo '<li class="text-muted">No experiences provided.</li>';
                              } else {
                                foreach ($exps as $e) {
                                  echo '<li>' . htmlspecialchars($e) . '</li>';
                                }
                              }
                            ?>
                          </ul>
                        </div>
                        <div class="col-md-3 text-center">
                          <strong>Image</strong>
                          <div class="mt-2">
                            <?php if (!empty($row['image_url'])): ?>
                              <img src="<?= '../../Counsellor_page_images/' . htmlspecialchars($row['image_url']) ?>"
                                   alt="Counsellor Image"
                                   style="max-width:100%; height:120px; object-fit:cover; border-radius:6px;">
                            <?php else: ?>
                              <div class="text-muted">No image</div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

      <nav>
        <ul class="pagination justify-content-end">
          <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <li class="page-item <?= $p === $page ? 'active' : '' ?>">
              <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
  </div>

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.table-col -->

      </div> <!-- /.no-wrap-row -->

    </div> <!-- /.container-fluid -->

<?php
    $content = ob_get_clean();
require '../layouts/master.php';
?>

<script>
   
function deleteCounsellor(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "This counsellor record will be permanently deleted!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      // Optionally show a “Deleted!” toast before redirect
      Swal.fire({
        title: "Deleted!",
        text: "The counsellor has been deleted.",
        icon: "success",
        showConfirmButton: false
      })
      .then(() => {
        // Redirect to your delete script
        window.location.href = 'delete_counsellor.php?id=' + id;
      });
    }
  });
}
// Toggle chevron icon for each collapse target
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.collapse').forEach(c => {
    c.addEventListener('show.bs.collapse', (ev) => {
      const id = ev.target.id.replace('detail-','');
      const toggle = document.querySelector(`.main-row[data-id="${id}"] .toggle-cell a i`);
      if (toggle) {
        toggle.classList.remove('fa-chevron-right');
        toggle.classList.add('fa-chevron-down');
      }
    });
    c.addEventListener('hide.bs.collapse', (ev) => {
      const id = ev.target.id.replace('detail-','');
      const toggle = document.querySelector(`.main-row[data-id="${id}"] .toggle-cell a i`);
      if (toggle) {
        toggle.classList.remove('fa-chevron-down');
        toggle.classList.add('fa-chevron-right');
      }
    });
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($success): ?>
    Swal.fire({
      icon: 'success',
      title: 'Created!',
      text: <?= json_encode($success) ?>,
      timer: 2000,
      showConfirmButton: false
    });
  <?php elseif ($error): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: <?= json_encode($error) ?>,
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
});
</script>
