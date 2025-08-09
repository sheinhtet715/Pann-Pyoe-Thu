

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