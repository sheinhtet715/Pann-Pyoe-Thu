
    <?php
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
        if (! $ins->execute()) {
            $error = "Insert failed: " . $ins->error;
        }
        $ins->close();
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?page={$page}");
    exit;
}

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
                                        <form action="" method="post" class="p-3 rounded" enctype="multipart/form-data">
                                            <input type="text" name="counsellor_name"   class="form-control mb-3" placeholder="Name..." required>
                                            <input type="text" name="degree"             class="form-control mb-3" placeholder="Degree..." required>
                                            <input type="text" name="specialization"     class="form-control mb-3" placeholder="Specialization..." required>
                                            <input type="text" name="phone"              class="form-control mb-3" placeholder="Phone...">
                                            <input type="email" name="email"             class="form-control mb-3" placeholder="Email...">
                                            <textarea    name="experiences"  class="form-control mb-3" placeholder="Experiences (semi-colon separated)"></textarea>
                                               <input type="file" name="image" id="" accept="image/*" class="form-control mt-1"onchange="loadFile(event)">
                                            <button type="submit" name="create" class="btn btn-outline-primary mt-3">Create</button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="col ">
                                <table class="table table-hover shadow-sm ">
                                    <thead class="bg-primary text-white">
                                           <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Degree</th>
                                            <th>Specialization</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = $list->fetch_assoc()): ?>
                                        <tr>
                                        <td><?= $row['counsellor_id'] ?></td>
                                        <td><?= htmlspecialchars($row['counsellor_name']) ?></td>
                                        <td><?= htmlspecialchars($row['degree']) ?></td>
                                        <td><?= htmlspecialchars($row['specialization']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['counsellor_id'] ?>"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                          <button type="button"
                                                onclick="deleteCounsellor(<?= $row['counsellor_id'] ?>)"
                                                class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        </td>
                                        </tr>
                                    <?php endwhile; ?>

                                    </tbody>
                                </table>
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

</script>