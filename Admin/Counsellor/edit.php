<?php
// update_counsellor.php
session_start();
include '../database/db_connection.php';

// 1) Validate & fetch existing record
if (empty($_GET['id']) || ! is_numeric($_GET['id'])) {
    header('Location: list.php');
    exit;
}
$id = (int)$_GET['id'];

// Fetch current data
$stmt = $conn->prepare("
    SELECT counsellor_name, degree, specialization,
           phone, email, experiences, image_url
      FROM Counsellor_tbl
     WHERE counsellor_id = ?
     LIMIT 1
");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 1) {
    $stmt->close();
    header('Location: list.php');
    exit;
}
$current = $result->fetch_assoc();
$stmt->close();

$error = '';
$success = '';
// 2) Handle POST → Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['counsellor_name']   ?? '');
    $degree  = trim($_POST['degree']             ?? '');
    $spec    = trim($_POST['specialization']     ?? '');
    $phone   = trim($_POST['phone']              ?? '');
    $email   = trim($_POST['email']              ?? '');
    $exp     = trim($_POST['experiences']        ?? '');
    
    // Handle optional new image upload
    $imgFilename = $current['image_url'];
    if (! empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../Counsellor_page_images/';
        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $tmp     = $_FILES['image']['tmp_name'];
        $orig    = basename($_FILES['image']['name']);
        $ext     = pathinfo($orig, PATHINFO_EXTENSION);
        $newName = uniqid('img_', true) . '.' . $ext;
        $target  = $uploadDir . $newName;

        if (move_uploaded_file($tmp, $target)) {
            $imgFilename = $newName;
            // (Optional) unlink old image:
            if ($current['image_url']) {
                @unlink($uploadDir . $current['image_url']);
            }
        } else {
            $error = "Failed to upload new image.";
        }
    }

    // Basic validation
    if ($name === '' || $degree === '' || $spec === '') {
        $error = "Name, Degree and Specialization are required.";
    }

    // Perform update if no error
    if ($error === '') {
        $upd = $conn->prepare("
            UPDATE Counsellor_tbl
               SET counsellor_name = ?,
                   degree           = ?,
                   specialization   = ?,
                   phone            = ?,
                   email            = ?,
                   experiences      = ?,
                   image_url        = ?
             WHERE counsellor_id   = ?
             LIMIT 1
        ");
        $upd->bind_param(
            "sssssssi",
            $name, $degree, $spec,
            $phone, $email, $exp,
            $imgFilename, $id
        );
            if ($upd->execute()) {
        $success = "Counsellor updated successfully!";
        // refresh current data if needed…
    } else {
        $error = "Update failed: " . $upd->error;
    }
    $upd->close();
    // Redirect to GET so reload won’t re-submit the form
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}
    }

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
                            <form method="post"
                action=""
                enctype="multipart/form-data">
            <div class="mb-3">
              <label>Name *</label>
              <input type="text"
                     name="counsellor_name"
                     class="form-control"
                     required
                     value="<?= htmlspecialchars($current['counsellor_name']) ?>">
            </div>
            <div class="mb-3">
              <label>Degree *</label>
              <input type="text"
                     name="degree"
                     class="form-control"
                     required
                     value="<?= htmlspecialchars($current['degree']) ?>">
            </div>
            <div class="mb-3">
              <label>Specialization *</label>
              <input type="text"
                     name="specialization"
                     class="form-control"
                     required
                     value="<?= htmlspecialchars($current['specialization']) ?>">
            </div>
            <div class="mb-3">
              <label>Phone</label>
              <input type="text"
                     name="phone"
                     class="form-control"
                     value="<?= htmlspecialchars($current['phone']) ?>">
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email"
                     name="email"
                     class="form-control"
                     value="<?= htmlspecialchars($current['email']) ?>">
            </div>
            <div class="mb-3">
              <label>Experiences</label>
              <textarea name="experiences"
                        class="form-control"
                        rows="3"><?= htmlspecialchars($current['experiences']) ?></textarea>
            </div>
            <div class="mb-3">
              <label>Current Image</label><br>
              <?php if ($current['image_url']): ?>
                <?php 
                    $testPath = '../../Counsellor_page_images/' . $current['image_url'];
                    echo '<!-- DEBUG: image path → ' . htmlspecialchars($testPath) . ' -->'; 
                    ?>
                <img 
                        src="<?= htmlspecialchars('../../Counsellor_page_images/' . $current['image_url']) ?>"
                        alt="current image"
                        style="width:130px; height:130px; object-fit:cover;"
                        >
              <?php else: ?>
                <span class="text-muted">No image</span>
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label>Replace Image</label>
              <input type="file"
                     name="image"
                     accept="image/*"
                     class="form-control">
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

