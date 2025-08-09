<?php
include '../database/db_connection.php'; // adjust path
    $error = '';
$id = isset($_GET['job_id']) ? (int) $_GET['job_id'] : 0;

if ($id <= 0) {
    die("Invalid job ID.");
}

$stmt = $pdo->prepare("SELECT * FROM Job_tbl WHERE job_id = ?");
$stmt->execute([$id]);
$current = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$current) {
    die("Job not found.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $org_name     = $_POST['org_name'];
    $job_title    = $_POST['job_title'];
    $job_type = trim(strtolower($_POST['job_type']));
    $location     = $_POST['location'];
    $description  = $_POST['description'];
    $requirement  = $_POST['requirement'];
    $job_attachment = $_POST['job_attachment'];
    $imglogo_url  = $current['imglogo_url'];

    $allowed_types = ['full time', 'part time'];
    if (!in_array($job_type, $allowed_types)) {
    $error = "Invalid Job Type. Please enter 'full time' or 'part time' only.";
}
else{
    // If new image uploaded
    if (!empty($_FILES['imglogo_url']['name'])) {
        $filename = basename($_FILES['imglogo_url']['name']);
        move_uploaded_file($_FILES['imglogo_url']['tmp_name'], "../../Job page images/" . $filename);
        $imglogo_url = $filename;
    }

    $stmt = $pdo->prepare("UPDATE Job_tbl 
        SET org_name=?, job_title=?, job_type=?, location=?, description=?, requirement=?, job_attachment=?, imglogo_url=? 
        WHERE job_id=?");
    $stmt->execute([$org_name, $job_title, $job_type, $location, $description, $requirement, $job_attachment, $imglogo_url, $id]);

    header("Location: list.php");
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
            <h1 class="h3 mb-0 text-gray-800">Jobs Update Page</h1>
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
              <label>Organization *</label>
              <input type="text"
                     name="org_name"
                     class="form-control"
                     required
                     value="<?= htmlspecialchars($current['org_name']) ?>">
            </div>
            <div class="mb-3">
              <label>Job Title  *</label>
              <input type="text"
                     name="job_title"
                     class="form-control"
                     required
                     value="<?= htmlspecialchars($current['job_title']) ?>">
            </div>
            <div class="mb-3">
              <label>Job Type *</label>
              <input type="text"
                     name="job_type"
                     class="form-control"
                     required
                     value="<?= htmlspecialchars($current['job_type']) ?>">
            </div>
            <div class="mb-3">
              <label>Location</label>
              <input type="text"
                     name="location"
                     class="form-control"
                     value="<?= htmlspecialchars($current['location']) ?>">
            </div>
            <div class="mb-3">
              <label>Description</label>
              <label>Description</label>
  <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($current['description']) ?></textarea>
            </div>
            <div class="mb-3">
              <label>Requirement</label>
              <textarea name="requirement"
                        class="form-control"
                        rows="3"><?= htmlspecialchars($current['requirement']) ?></textarea>
            </div>
              <div class="mb-3">
              <label class="form-label">Job Attachment Link </label>
              <input type="url" name="job_attachment" class="form-control"  value="<?= htmlspecialchars($current['job_attachment']) ?>">
            </div>
          
          
              <div class="mb-3">
              <label>Current Image</label><br>
 
                <img 
                        src="<?= htmlspecialchars('../../Job page images/' . $current['imglogo_url']) ?>"
                        alt="current image"
                        style="width:130px; height:130px; object-fit:cover;"
                        >

            </div>
            <div class="mb-3">
              <label>Replace Image</label>
              <input type="file"
                     name="imglogo_url"
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
<?php if ($error): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "<?= addslashes($error) ?>",
        confirmButtonText: "OK"
    }).then(() => {
        // Redirect back to the same edit page (you are already on it, so reload)
        window.location.href = "edit.php?job_id=<?= $id ?>";
    });
</script>
<?php endif; ?>
    
