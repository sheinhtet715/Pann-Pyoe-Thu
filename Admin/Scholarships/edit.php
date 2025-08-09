<?php
    // Admin/Scholarship/edit.php
session_name('ADMINSESSID');
session_start();
    include '../database/db_connection.php';

    // 1) Validate & load existing record
    if (empty($_GET['id']) || ! is_numeric($_GET['id'])) {
        header('Location: list.php');
        exit;
    }
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("
  SELECT
    title, description, logo_url, coverage, country,
    apply_link, deadline, intake_season, degree_level, `type`, eligibility
  FROM Scholarship_tbl
  WHERE scholarship_id = ?
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

    $error   = '';
    $success = '';

    // 2) Handle the POST → Update + PRG
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // sanitize inputs
        $title        = trim($_POST['title'] ?? '');
        $description  = trim($_POST['description'] ?? '');
        $coverage     = trim($_POST['coverage'] ?? '');
        $country      = trim($_POST['country'] ?? '');
        $apply_link   = trim($_POST['apply_link'] ?? '');
        $deadline     = trim($_POST['deadline'] ?? '');
        $intake       = trim($_POST['intake_season'] ?? '');
        $degree_level = trim($_POST['degree_level'] ?? '');
        $type         = trim($_POST['type'] ?? '');
        $eligibility  = trim($_POST['eligibility'] ?? '');

        // handle optional logo upload
        $logoFilename = $current['logo_url'];
        if (! empty($_FILES['logo']['name'])) {
            $uploadDir = __DIR__ . '/../../Scholarships_page_images/';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $tmp     = $_FILES['logo']['tmp_name'];
            $orig    = basename($_FILES['logo']['name']);
            $ext     = pathinfo($orig, PATHINFO_EXTENSION);
            $newName = uniqid('logo_', true) . '.' . $ext;
            $target  = $uploadDir . $newName;

            if (move_uploaded_file($tmp, $target)) {
                // remove old file if exists
                if ($current['logo_url']) {
                    @unlink($uploadDir . $current['logo_url']);
                }
                $logoFilename = $newName;
            } else {
                $error = "Failed to upload new logo.";
            }
        }

        // validation
        if ($title === '' || $country === '' || $intake === '') {
            $error = "Title, Country, and Intake Season are required.";
        }

        if ($error === '') {
            $upd = $conn->prepare("
          UPDATE Scholarship_tbl
             SET title         = ?,
                 description   = ?,
                 logo_url      = ?,
                 coverage      = ?,
                 country       = ?,
                 apply_link    = ?,
                 deadline      = ?,
                 intake_season = ?,
                 degree_level  = ?,
                 `type`        = ?,
                 eligibility   = ?
           WHERE scholarship_id = ?
           LIMIT 1
        ");
            $upd->bind_param(
                "sssssssssssi",
                $title, $description, $logoFilename, $coverage,
                $country, $apply_link, $deadline, $intake,
                $degree_level, $type, $eligibility,
                $id
            );
            if ($upd->execute()) {
                $_SESSION['flash_success'] = "Scholarship updated successfully!";
            } else {
                $_SESSION['flash_error'] = "Update failed: " . $upd->error;
            }
            $upd->close();

            // redirect to clear POST
            header("Location: edit.php?id={$id}");
            exit;
        }
    }

    // 3) Read flash messages on GET
    if (! empty($_SESSION['flash_success'])) {
        $success = $_SESSION['flash_success'];
        unset($_SESSION['flash_success']);
    }
    if (! empty($_SESSION['flash_error'])) {
        $error = $_SESSION['flash_error'];
        unset($_SESSION['flash_error']);
    }

?>


<?php ob_start(); ?>

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
                                       <form method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                            <label>Title *</label>
                                            <input type="text" name="title" class="form-control" required
                                                    value="<?php echo htmlspecialchars($current['title'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($current['description'])?></textarea>
                                            </div>
                                            <div class="mb-3">
                                            <label>Current Logo</label><br>
                                            <?php if ($current['logo_url']): ?>
                                                <img src="../../Scholarships_page_images/<?php echo htmlspecialchars($current['logo_url'])?>"
                                                    alt="logo" style="width:80px;height:80px;object-fit:contain;">
                                            <?php else: ?>
                                                <span class="text-muted">No logo</span>
                                            <?php endif; ?>
                                            </div>
                                            <div class="mb-3">
                                            <label>Replace Logo</label>
                                            <input type="file" name="logo" accept="image/*" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                            <label>Coverage</label>
                                            <textarea name="coverage" class="form-control" rows="2"><?php echo htmlspecialchars($current['coverage'])?></textarea>
                                            </div>
                                            <div class="mb-3">
                                            <label>Country *</label>
                                            <input type="text" name="country" class="form-control" required
                                                    value="<?php echo htmlspecialchars($current['country'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Apply Link</label>
                                            <input type="url" name="apply_link" class="form-control"
                                                    value="<?php echo htmlspecialchars($current['apply_link'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Deadline</label>
                                            <input type="text" name="deadline" class="form-control"
                                                    value="<?php echo htmlspecialchars($current['deadline'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Intake Season *</label>
                                            <input type="text" name="intake_season" class="form-control" required
                                                    value="<?php echo htmlspecialchars($current['intake_season'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Degree Level</label>
                                            <input type="text" name="degree_level" class="form-control"
                                                    value="<?php echo htmlspecialchars($current['degree_level'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Type</label>
                                            <input type="text" name="type" class="form-control"
                                                    value="<?php echo htmlspecialchars($current['type'])?>">
                                            </div>
                                            <div class="mb-3">
                                            <label>Eligibility</label>
                                            <textarea name="eligibility" class="form-control" rows="2"><?php echo htmlspecialchars($current['eligibility'])?></textarea>
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
<!-- SweetAlert2 for flash messages -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($success): ?>
    Swal.fire({ icon: 'success', title: 'Updated!', text: <?= json_encode($success) ?> });
  <?php elseif ($error): ?>
    Swal.fire({ icon: 'error',  title: 'Error',   text: <?= json_encode($error) ?> });
  <?php endif; ?>
});
</script>