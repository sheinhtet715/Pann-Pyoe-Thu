<?php
session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php';

$limit = 3; 
$page  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// prepare the like pattern
$searchKey = $_GET['searchKey'] ?? '';
$like = "%" . $searchKey . "%";

/* COUNT total rows (for pagination) - include u.user_name */
$countSql = "SELECT COUNT(*) as total
             FROM Payment_tbl p
             INNER JOIN Enrollment_tbl e ON p.enrollment_id = e.enrollment_id
             INNER JOIN user_tbl u ON e.user_id = u.user_id
             WHERE p.enrollment_id LIKE ?
               OR p.payment_method LIKE ?
               OR e.user_id LIKE ?
               OR u.user_name LIKE ?";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("ssss", $like, $like, $like, $like);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalRows = (int)$countResult['total'];
$totalPages = ($totalRows > 0) ? (int)ceil($totalRows / $limit) : 1;
$countStmt->close();

/* FETCH paginated rows (include u.user_name) */
$dataSql = "SELECT p.*, e.user_id, e.course_id, e.enrollment_date, u.user_name
            FROM Payment_tbl p
            INNER JOIN Enrollment_tbl e ON p.enrollment_id = e.enrollment_id
            INNER JOIN user_tbl u ON e.user_id = u.user_id
            WHERE p.enrollment_id LIKE ?
               OR p.payment_method LIKE ?
               OR e.user_id LIKE ?
               OR u.user_name LIKE ?
            ORDER BY p.payment_id DESC
            LIMIT ? OFFSET ?";
$dataStmt = $conn->prepare($dataSql);
$dataStmt->bind_param("ssssii", $like, $like, $like, $like, $limit, $offset);
$dataStmt->execute();
$result = $dataStmt->get_result();

?>
<?php
ob_start();
?>
<style>
/* SweetAlert image responsiveness */
.swal2-image {
    width: 100%;
    height: auto;
    max-width: 90vw;
    max-height: 80vh;
    border-radius: 10px;
    object-fit: contain;
    transition: transform 0.2s ease; /* smooth zooming */
}
.swal2-no-padding {
    padding: 0 !important;
}
</style>

<div class="container-fluid">
    <!-- Top controls -->
    <div class="d-flex flex-wrap justify-content-between my-2">
        <div class="mb-2">
            <!-- Left content (empty for now, or add buttons later) -->
        </div>
        <div class="ms-auto" style="max-width:400px; flex:1;">
            <form action="" method="get">
                <div class="input-group">
                    <input type="text" 
                           name="searchKey" 
                           value="<?= htmlspecialchars($_GET['searchKey'] ?? '') ?>" 
                           class="form-control" 
                           placeholder="Enter Search Key...">
                    <button type="submit" class="btn bg-dark text-white"> 
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="row">
        <div class="col">
            <div class="table-responsive shadow-sm">
                <table class="table table-hover align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Receipt</th>
                            <th>Enrollment ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Course ID</th>
                            <th>Enrollment Date</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                       <?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <?php if ($row['payment_receipt']): ?>
                                           <img src="../../PHP/<?= htmlspecialchars($row['payment_receipt']) ?>" 
                                                class="img-thumbnail rounded shadow-sm receipt-img" 
                                                style="max-width:60px; height:auto; cursor:pointer;" 
                                                alt="receipt"
                                                data-src="../../PHP/<?= htmlspecialchars($row['payment_receipt']) ?>">
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['enrollment_id'] ?></td>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= $row['user_name'] ?></td>
                                    <td><?= $row['course_id'] ?></td>
                                    <td><?= $row['enrollment_date'] ?></td>
                                    <td><?= $row['amount'] ?> MMK</td>
                                    <td><?= $row['payment_date'] ?: '<span class="text-muted">N/A</span>' ?></td>
                                    <td><?= $row['payment_method'] ?: '<span class="text-muted">N/A</span>' ?></td>
                                    <td>
                                        <select class="form-select status-change" 
                                                data-payment-id="<?= $row['payment_id'] ?>" 
                                                data-enrollment-id="<?= $row['enrollment_id'] ?>">
                                            <option value="pending" <?= $row['payment_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="confirm" <?= $row['payment_status'] === 'confirm' ? 'selected' : '' ?>>Confirm</option>
                                            <option value="reject" <?= $row['payment_status'] === 'reject' ? 'selected' : '' ?>>Reject</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn" 
                                            data-payment-id="<?= $row['payment_id'] ?>" 
                                            data-enrollment-id="<?= $row['enrollment_id'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                            <td colspan="10" class="text-center text-muted">No payments found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- 3️⃣ Pagination -->
<?php if ($totalPages > 1): ?>
<nav>
  <ul class="pagination justify-content-end mt-5">
    <?php for ($p = 1; $p <= $totalPages; $p++): 
      $active = $p === $page ? 'active' : '';
      $qs = $searchKey !== '' ? '&searchKey=' . urlencode($searchKey) : '';
    ?>
      <li class="page-item <?= $active ?>">
        <a class="page-link" href="?page=<?= $p . $qs ?>"><?= $p ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>

<!-- SweetAlert2 + AJAX -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.status-change').forEach(sel => {
    sel.addEventListener('change', function() {
        let paymentId = this.dataset.paymentId;
        let enrollmentId = this.dataset.enrollmentId;
        let newStatus = this.value;

        Swal.fire({
            title: 'Are you sure?',
            text: "Change status to " + newStatus + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('update.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `payment_id=${paymentId}&enrollment_id=${enrollmentId}&payment_status=${newStatus}`
                }).then(res => res.text()).then(data => {
                    Swal.fire('Updated!', data, 'success');
                });
            } else {
                location.reload();
            }
        });
    });
});

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        let paymentId = this.dataset.paymentId;
        let enrollmentId = this.dataset.enrollmentId;

        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be deleted permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('delete.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `payment_id=${paymentId}&enrollment_id=${enrollmentId}`
                }).then(res => res.text()).then(data => {
                    Swal.fire('Deleted!', data, 'success').then(() => {
                        location.reload();
                    });
                });
            }
        });
    });
});
</script>
<script>
document.querySelectorAll('.receipt-img').forEach(img => {
    img.addEventListener('click', function() {
        let src = this.dataset.src;
        Swal.fire({
            imageUrl: src,
            imageAlt: 'Receipt',
            showConfirmButton: false,
            showCloseButton: true,
            background: '#b3acac',
            customClass: {
                popup: 'swal2-no-padding'
            }
        });
    });
});
// JS: Open SweetAlert2 image with zoom
document.querySelectorAll('.img-thumbnail').forEach(img => {
    img.addEventListener('click', () => {
        Swal.fire({
            imageUrl: img.src,
            imageAlt: 'Receipt',
            showCloseButton: true,
            showConfirmButton: false,
            background: '#b3acac',
            customClass: {
                image: 'swal2-image',
                popup: 'swal2-no-padding'
            },
            didOpen: () => {
                const swalImage = Swal.getImage();
                let scale = 1;

                // Zoom with mouse wheel
                swalImage.addEventListener('wheel', e => {
                    e.preventDefault();
                    if (e.deltaY < 0) {
                        scale += 0.1; // zoom in
                    } else {
                        scale -= 0.1; // zoom out
                        if (scale < 0.1) scale = 0.1; // minimum scale
                    }
                    swalImage.style.transform = `scale(${scale})`;
                });
            }
        });
    });
});

</script>



<?php
$content = ob_get_clean();
require '../layouts/master.php';
?>
