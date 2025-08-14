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
        if (! empty($_FILES['image_url']['name'])) {
            $uploadDir  = '../../Courses page Images/';
            $imageName  = basename($_FILES['image_url']['name']);
            $targetFile = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
                $image_url = $imageName;
            }
        }

        // Handle icon upload
        $icon_url = null;
        if (! empty($_FILES['icon']['name'])) {
            $uploadDir  = '../../Courses page Images/';
            $iconName   = basename($_FILES['icon']['name']);
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
            $icon_url,
        ]);
    }

                 // Pagination setup
    $limit  = 7; // items per page
    $page   = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    // Get total courses count for pagination
    $totalCountStmt = $pdo->query("SELECT COUNT(*) FROM Course_tbl");
    $totalCourses   = $totalCountStmt->fetchColumn();
    $totalPages     = ceil($totalCourses / $limit);

    // Fetch courses for current page
    $stmt = $pdo->prepare("SELECT * FROM Course_tbl ORDER BY course_id DESC LIMIT ? OFFSET ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>













<?php ob_start(); ?>
<style>
    .no-wrap-row { display:flex; flex-wrap:nowrap; gap:1rem; align-items:flex-start; }
      .form-col { flex:0 0 360px; max-width:440px; min-width:260px; }
      .table-col { flex:1 1 0; min-width:0; }
      .table-col .table-responsive { overflow-x:auto; }
      .card.form-card{height:100%;}
      .table thead th { white-space:nowrap; }
      .detail-inner { padding:1rem; }
/* style for the hidden detail row */
.detail-row { display: none; }
.detail-row .detail-cell { padding: .75rem 1rem; background: #f8f9fa; }
.toggle-btn { width: 34px; height: 34px; padding: 6px; }
</style>
<!-- Begin Page Content -->
                 <div class="container-fluid py-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Counsellor List</h1>
                    </div>

                     <div class="no-wrap-row">

        <!-- LEFT: form column -->
        <div class="form-col">
                         <div class="card form-card shadow-sm">
            <div class="card-body p-3">

                                             <form action="" method="post" enctype="multipart/form-data" class="p-3 rounded">
                                               <div class="mb-3">
                  <input type="text" name="course_name" class="form-control" placeholder="Course Name..." required>
                </div>
                <div class="mb-3">
                  <input type="text" name="fee" class="form-control" placeholder="Fee...">
                </div>
                <div class="mb-3">
                  <input type="text" name="type" class="form-control" placeholder="Type...">
                </div>
                <div class="mb-3">
                  <input type="text" name="language" class="form-control" placeholder="Language...">
                </div>
                <div class="mb-3">
                  <input type="text" name="instructor_name" class="form-control" placeholder="Instructor Name...">
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" name="paid_status" id="paid_status" class="form-check-input">
                  <label for="paid_status" class="form-check-label">Paid Course?</label>
                </div>
                <div class="mb-2">
                  <label class="form-label">Course Image</label>
                  <input type="file" name="image_url" accept="image/*" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Icon Image</label>
                  <input type="file" name="icon" accept="image/*" class="form-control">
                </div>
                <button type="submit" name="create" class="btn btn-outline-primary w-100">Create</button>
              </form>
</div>
          </div>
        </div>
                   <!-- RIGHT: table column -->
        <div class="table-col">
          <div class="card shadow-sm">
            <div class="card-body p-0">

              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead class="bg-primary text-white">
                                        <tr>
                                        <th></th> <!-- toggle column -->
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Fee</th>
                                        <th>Type</th>
                                        <th>Language</th>
                                        <th>Paid</th>

                                        <th></th> <!-- actions -->
                                    </tr>
                                </thead>
                                <tbody>
                <?php if (! $courses): ?>
                    <tr><td colspan="11" class="text-center">No courses found.</td></tr>
                <?php else: ?>
<?php foreach ($courses as $course): ?>
                <!-- main row -->
                <tr class="main-row" data-course-id="<?php echo htmlspecialchars($course['course_id']) ?>">
                    <td class="text-center align-middle">
                        <button type="button" class="btn btn-sm btn-outline-secondary toggle-btn" aria-expanded="false" title="Show details">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </td>

                    <td class="align-middle"><?php echo htmlspecialchars($course['course_id']) ?></td>
                    <td class="align-middle"><?php echo htmlspecialchars($course['course_name']) ?></td>
                    <td class="align-middle"><?php echo htmlspecialchars($course['fee']) ?></td>
                    <td class="align-middle"><?php echo htmlspecialchars($course['type']) ?></td>
                    <td class="align-middle"><?php echo htmlspecialchars($course['language']) ?></td>
                    <td class="align-middle"><?php echo $course['paid_status'] ? 'Yes' : 'No' ?></td>






                    <td class="align-middle">
                        <a href="edit.php?course_id=<?php echo $course['course_id'] ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button type="button" onclick="deleteCourse(<?php echo $course['course_id'] ?>)" class="btn btn-sm btn-outline-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- detail row (hidden by default) -->
                <tr class="detail-row" aria-hidden="true">
                  <td colspan="8" class="bg-light">
                    <div class="detail-inner bg-light border-top">

                                <strong>Instructor:</strong>
                                <?php echo htmlspecialchars($course['instructor_name']) ?: '-' ?><br>



                                <strong class="mt-2 d-block">Image</strong>
                                <div class="mt-1">
                                    <?php if ($course['image_url']): ?>
                                        <img src="<?php echo '../../Courses page Images/' . htmlspecialchars($course['image_url']) ?>" alt="Course Image" style="max-width:180px; height:auto; border-radius:4px;"><br>
                                    <?php else: ?>
                                          <span class="text-muted">-</span><br>
                                    <?php endif; ?>
                                </div>



                                <strong class="mt-2 d-block">Icon</strong>
                                <div class="mt-1">
                                    <?php if ($course['icon_url']): ?>
                                        <img src="<?php echo '../../Courses page Images/' . htmlspecialchars($course['icon_url']) ?>" alt="Icon Image" style="max-width:80px; height:auto; border-radius:4px;"><br>
                                    <?php else: ?>
                                          <span class="text-muted">-</span><br>
                                    <?php endif; ?>
                                </div>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
<?php endif; ?>
    </tbody>
</table>
</div> <!-- /.table-responsive -->

              

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.table-col -->

      </div> <!-- /.no-wrap-row -->

                <nav>
                  <ul class="pagination justify-content-end mb-0">
                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                      <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                      </li>
                    <?php endfor; ?>
                  </ul>
                </nav>
             
    </div> <!-- /.container-fluid -->
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

<script>
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