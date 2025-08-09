<?php

session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php';

// Get course_id from GET parameter
if (empty($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    header('Location: list.php');
    exit;
}

$course_id = (int) $_GET['course_id'];

// Fetch current course data
$stmt = $pdo->prepare("SELECT * FROM Course_tbl WHERE course_id = ?");
$stmt->execute([$course_id]);
$current = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$current) {
    // Course not found
    $_SESSION['flash_error'] = "Course not found.";
    header('Location: list.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_name     = $_POST['course_name'] ?? '';
    $fee             = $_POST['fee'] ?? '';
    $type            = $_POST['type'] ?? '';
    $language        = $_POST['language'] ?? '';
    $paid_status     = isset($_POST['paid_status']) ? 1 : 0;
    $instructor_name = $_POST['instructor_name'] ?? '';

    $image_url = $current['image_url'];
    $icon_url = $current['icon_url'];

    // Handle new image upload
    if (!empty($_FILES['image_url']['name'])) {
        $uploadDir = '../../Courses page Images/';
        $imageName = basename($_FILES['image_url']['name']);
        $targetFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
            $image_url = $imageName;
        }
    }

    // Handle new icon upload
    if (!empty($_FILES['icon']['name'])) {
        $uploadDir = '../../Courses page Images/';
        $iconName = basename($_FILES['icon']['name']);
        $targetFile = $uploadDir . $iconName;

        if (move_uploaded_file($_FILES['icon']['tmp_name'], $targetFile)) {
            $icon_url = $iconName;
        }
    }
   // ... existing POST data retrieval ...

$most_popular = isset($_POST['most_popular']) ? 1 : 0;

if ($most_popular === 1) {
    // Reset others
    $pdo->exec("UPDATE Course_tbl SET most_popular = 0 WHERE course_id != $course_id");
}

$stmt = $pdo->prepare("UPDATE Course_tbl SET course_name=?, fee=?, type=?, language=?, paid_status=?, instructor_name=?, image_url=?, icon_url=?, most_popular=? WHERE course_id=?");
$stmt->execute([
    $course_name,
    $fee,
    $type,
    $language,
    $paid_status,
    $instructor_name,
    $image_url,
    $icon_url,
    $most_popular,
    $course_id
]);



    $_SESSION['flash_success'] = "Course updated successfully.";
    header('Location: list.php');
    exit;
}

ob_start();
?>

<?php
    ob_start();
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Counsellor Update Page</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="card">
                        <div class="card-title">
                            <a href="./list.php"
                                class="btn btn-sm bg-dark mt-2 mx-2 text-white rounded shadow-sm">Back</a>
                        </div>
                        <div class="card-body shadow">
                            <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Course Name *</label>
                                <input type="text" name="course_name" class="form-control" required
                                       value="<?= htmlspecialchars($current['course_name']) ?>">
                            </div>
                            <div class="mb-3">
                                <label>Fee *</label>
                                <input type="text" name="fee" class="form-control" required
                                       value="<?= htmlspecialchars($current['fee']) ?>">
                            </div>
                            <div class="mb-3">
                                <label>Type *</label>
                                <input type="text" name="type" class="form-control" required
                                       value="<?= htmlspecialchars($current['type']) ?>">
                            </div>
                            <div class="mb-3">
                                <label>Language</label>
                                <input type="text" name="language" class="form-control"
                                       value="<?= htmlspecialchars($current['language']) ?>">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="paid_status" id="paid_status" class="form-check-input"
                                    <?= $current['paid_status'] ? 'checked' : '' ?>>
                                <label for="paid_status" class="form-check-label">Paid Course?</label>
                            </div>
                            <div class="mb-3">
                                <label>Instructor Name</label>
                                <input type="text" name="instructor_name" class="form-control"
                                       value="<?= htmlspecialchars($current['instructor_name']) ?>">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="most_popular" id="most_popular" class="form-check-input"
                                    <?= $current['most_popular'] ? 'checked' : '' ?>>
                                <label for="most_popular" class="form-check-label">Most Popular?</label>
                            </div>

                            <div class="mb-3">
                                <label>Current Course Image</label><br>
                                <?php if ($current['image_url']): ?>
                                    <img src="<?= htmlspecialchars('../../Courses page Images/' . $current['image_url']) ?>"
                                         alt="current image" style="width:130px; height:130px; object-fit:cover;">
                                <?php else: ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label>Replace Image</label>
                                <input type="file" name="image_url" accept="image/*" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Current Icon Image</label><br>
                                <?php if ($current['icon_url']): ?>
                                    <img src="<?= htmlspecialchars('../../Courses page Images/' . $current['icon_url']) ?>"
                                         alt="current icon" style="width:130px; height:130px; object-fit:cover;">
                                <?php else: ?>
                                    <span class="text-muted">No icon image</span>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label>Replace Icon Image</label>
                                <input type="file" name="icon" accept="image/*" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="list.php" class="btn btn-secondary ms-2">Cancel</a>
                        </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

<?php
    $content = ob_get_clean();
    require '../layouts/master.php';
?>

