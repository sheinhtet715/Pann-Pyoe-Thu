<?php
// Admin/Scholarship/list.php
session_start();
include '../database/db_connection.php';

// ── 1) Handle Create (PRG) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    // sanitize inputs
    $title         = trim($_POST['title']         ?? '');
    $country       = trim($_POST['country']       ?? '');
    $intake        = trim($_POST['intake_season'] ?? '');
    $degree_level  = trim($_POST['degree_level']  ?? '');
    $type          = trim($_POST['type']          ?? '');
    $deadline      = trim($_POST['deadline']      ?? '');

    // handle logo upload
    $logoFilename = null;
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../Scholarships_page_images/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

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
            VALUES (?, NULL, ?, NULL, ?, NULL, ?, ?, ?, ?, NULL)
        ");
        $ins->bind_param(
            "sssssss",
            $title,
            $logoFilename,
            $country,
            $deadline,
            $intake,
            $degree_level,
            $type
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
$error   = $_SESSION['flash_error']   ?? '';
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

// ── 3) Pagination setup ──
$limit      = 5;
$page       = max(1, (int)($_GET['page'] ?? 1));
$offset     = ($page - 1) * $limit;
$totalRes   = $conn->query("SELECT COUNT(*) AS cnt FROM Scholarship_tbl");
$total      = $totalRes->fetch_assoc()['cnt'];
$totalPages = (int)ceil($total / $limit);

// ── 4) Fetch current page ──
$stmt = $conn->prepare("
    SELECT scholarship_id, title, country,
           intake_season, degree_level, `type`, deadline
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
                                         <form method="post" action="list.php" enctype="multipart/form-data">
            <div class="mb-2">
              <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="mb-2">
              <input type="text" name="country" class="form-control" placeholder="Country" required>
            </div>
            <div class="mb-2">
              <input type="text" name="intake_season" class="form-control" placeholder="Intake Season" required>
            </div>
            <div class="mb-2">
              <input type="text" name="degree_level" class="form-control" placeholder="Degree Level">
            </div>
            <div class="mb-2">
              <input type="text" name="type" class="form-control" placeholder="Type">
            </div>
            <div class="mb-2">
              <input type="text" name="deadline" class="form-control" placeholder="Deadline">
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
         <div class="col ">
  <table class="table table-hover shadow-sm">
    <thead class="bg-primary text-white">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Country</th>
        <th>Intake</th>
        <th>Degree</th>
        <th>Type</th>
        <th>Deadline</th>
        <th width="120px"></th>
      </tr>
    </thead>
    <tbody>
       <?php while ($row = $list->fetch_assoc()): ?>
          <tr>
            <td><?= $row['scholarship_id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['country']) ?></td>
            <td><?= htmlspecialchars($row['intake_season']) ?></td>
            <td><?= htmlspecialchars($row['degree_level']) ?></td>
            <td><?= htmlspecialchars($row['type']) ?></td>
            <td><?= htmlspecialchars($row['deadline']) ?></td>
            <td>
              <a href="edit.php?id=<?= $row['scholarship_id'] ?>"
                 class="btn btn-sm btn-light" title="Edit">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <button type="button"
                      onclick="confirmDelete(<?= $row['scholarship_id'] ?>)"
                      class="btn btn-sm btn-danger" title="Delete">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
          <?php endwhile; ?>
    </tbody>
  </table>
    </div>
  <!-- pagination -->
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