<?php
session_name('ADMINSESSID');
session_start(); 
include '../database/db_connection.php';

// Handle form submission to create new course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $course_name     = $_POST['course_name'] ?? '';
    $fee             = $_POST['fee'] ?? '';
    $type            = $_POST['type'] ?? '';
    $language        = $_POST['language'] ?? '';
    $paid_status     = isset($_POST['paid_status']) ? 1 : 0;
    $instructor_name = $_POST['instructor_name'] ?? '';

    // Handle image upload for course image
    $image_url = null;
    if (!empty($_FILES['image_url']['name'])) {
        $uploadDir = '../../Courses page Images/';
        $imageName = basename($_FILES['image_url']['name']);
        $targetFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
            $image_url = $imageName;
        }
    }

    // Handle icon upload
    $icon_url = null;
    if (!empty($_FILES['icon']['name'])) {
        $uploadDir = '../../Courses page Images/';
        $iconName = basename($_FILES['icon']['name']);
        $targetFile = $uploadDir . $iconName;

        if (move_uploaded_file($_FILES['icon']['tmp_name'], $targetFile)) {
            $icon_url = $iconName;
        }
    }

    // Insert new course into DB (using prepared statement)
    $stmt = $pdo->prepare("INSERT INTO Course_tbl
        (course_name, fee, type, language, paid_status, instructor_name, image_url, icon_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $course_name,
        $fee,
        $type,
        $language,
        $paid_status,
        $instructor_name,
        $image_url,
        $icon_url
    ]);
}

// Pagination setup
$limit = 7; // items per page
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Get total courses count for pagination
$totalCountStmt = $pdo->query("SELECT COUNT(*) FROM Course_tbl");
$totalCourses = $totalCountStmt->fetchColumn();
$totalPages = ceil($totalCourses / $limit);

// Fetch courses for current page
$stmt = $pdo->prepare("SELECT * FROM Course_tbl ORDER BY course_id DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

                                             <form action="" method="post" enctype="multipart/form-data" class="p-3 rounded">
                        <input type="text" name="course_name" class="form-control mb-3" placeholder="Course Name..." required>
                        <input type="text" name="fee" class="form-control mb-3" placeholder="Fee...">
                        <input type="text" name="type" class="form-control mb-3" placeholder="Type...">
                        <input type="text" name="language" class="form-control mb-3" placeholder="Language...">
                        <input type="text" name="instructor_name" class="form-control mb-3" placeholder="Instructor Name...">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="paid_status" id="paid_status" class="form-check-input">
                            <label for="paid_status" class="form-check-label">Paid Course?</label>
                        </div>
                        <label>Course Image</label>
                        <input type="file" name="image_url" accept="image/*" class="form-control mb-3">
                        <label>Icon Image</label>
                        <input type="file" name="icon" accept="image/*" class="form-control mb-3">
                        <button type="submit" name="create" class="btn btn-outline-primary mt-3 w-100">Create</button>
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
                        <th>Fee</th>
                        <th>Type</th>
                        <th>Language</th>
                        <th>Paid</th>
                        <th>Instructor</th>
                        <th>Image</th>       <!-- New -->
                        <th>Icon</th>   
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                     <?php if (!$courses): ?>
                        <tr><td colspan="8" class="text-center">No courses found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?= htmlspecialchars($course['course_id']) ?></td>
                                <td><?= htmlspecialchars($course['course_name']) ?></td>
                                <td><?= htmlspecialchars($course['fee']) ?></td>
                                <td><?= htmlspecialchars($course['type']) ?></td>
                                <td><?= htmlspecialchars($course['language']) ?></td>
                                <td><?= $course['paid_status'] ? 'Yes' : 'No' ?></td>
                                <td><?= htmlspecialchars($course['instructor_name']) ?></td>
                                <td>
                                <?php if ($course['image_url']): ?>
                                    <img src="<?= '../../Courses page Images/' . htmlspecialchars($course['image_url']) ?>" alt="Course Image" style="width: 80px; height: auto;">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($course['icon_url']): ?>
                                    <img src="<?= '../../Courses page Images/' . htmlspecialchars($course['icon_url']) ?>" alt="Icon Image" style="width: 50px; height: auto;">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                                <td>
                                    <a href="edit.php?course_id=<?= $course['course_id'] ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" onclick="deleteCourse(<?= $course['course_id'] ?>)" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
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
    
function deleteCourse(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "This course record will be permanently deleted!",
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
        text: "The course has been deleted.",
        icon: "success",
        showConfirmButton: false
      })
      .then(() => {
        // Redirect to your delete script
        window.location.href = 'delete.php?course_id=' + id;

      });
    }
  });
}
</script>