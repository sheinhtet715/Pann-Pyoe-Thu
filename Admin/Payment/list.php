<?php
session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php';

ob_start();
?>

<div class="container">
    <div class=" d-flex justify-content-between my-2">
        <div class=""></div>
        <div class="">
            <form action="" method="get">
                <div class="input-group">
                    <input type="text" name="searchKey" value="<?= htmlspecialchars($_GET['searchKey'] ?? '') ?>" class=" form-control"
                        placeholder="Enter Search Key...">
                    <button type="submit" class=" btn bg-dark text-white"> 
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover shadow-sm">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Receipt</th>
                        <th>Enrollment ID</th>
                        <th>User ID</th>
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
                    <?php
                    $searchKey = $_GET['searchKey'] ?? '';
                    $sql = "SELECT p.*, e.user_id, e.course_id, e.enrollment_date 
                            FROM Payment_tbl p
                            INNER JOIN Enrollment_tbl e ON p.enrollment_id = e.enrollment_id
                            WHERE p.enrollment_id LIKE ? OR p.payment_method LIKE ?";

                    $stmt = $conn->prepare($sql);
                    $like = "%$searchKey%";
                    $stmt->bind_param("ss", $like, $like);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php if ($row['payment_receipt']): ?>
                                        <img src="../../PHP/<?= htmlspecialchars($row['payment_receipt']) ?>" 
                                             class="img-thumbnail rounded shadow-sm" 
                                             style="width:auto; height:100px" alt="receipt">
                                    <?php else: ?>
                                        <span class="text-muted">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $row['enrollment_id'] ?></td>
                                <td><?= $row['user_id'] ?></td>
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
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="10">
                                <h5 class="text-muted text-center">No payments found</h5>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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

<?php
$content = ob_get_clean();
require '../layouts/master.php';
?>
