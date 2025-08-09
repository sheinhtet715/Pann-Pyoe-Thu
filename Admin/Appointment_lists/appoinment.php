<?php
// Admin/Appointments/list.php
session_name('ADMINSESSID');
session_start();

require '../database/db_connection.php'; // $conn (mysqli)

// Only admin users should access this (adjust role key if different)
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// pagination (optional)
$limit = 20;
$page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// fetch total count
$countStmt = $conn->prepare("SELECT COUNT(*) FROM Appointment_tbl");
$countStmt->execute();
$countStmt->bind_result($total);
$countStmt->fetch();
$countStmt->close();
$totalPages = max(1, ceil($total / $limit));

// fetch appointments with joins
$sql = "
  SELECT a.*, u.user_name, u.email as user_email, c.counsellor_name
  FROM Appointment_tbl a
  JOIN User_tbl u ON a.user_id = u.user_id
  JOIN Counsellor_tbl c ON a.counsellor_id = c.counsellor_id
  ORDER BY a.appointment_date DESC, a.appointment_time DESC
  LIMIT ? OFFSET ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$res = $stmt->get_result();
?>


<?php ob_start(); ?>
                <div class="container">
                    <div class=" d-flex justify-content-between my-2">
                        <div class="">
                         <button class="btn btn-secondary"><i class="fa-solid fa-calendar-check"></i> Appointment Count (<?= (int)$total ?>)</button>
                            
                        </div>
                        <div class="">
                          <form method="get" style="width:300px;">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search by user, counsellor, date..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                                <button class="btn bg-dark text-white" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-hover shadow-sm ">
                                <thead class="bg-primary text-white">
                                            <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Counsellor</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            </tr>

                                </thead>
                                <tbody>

                                   <?php if ($res->num_rows === 0): ?>
          <tr><td colspan="8" class="text-center">No appointments found.</td></tr>
        <?php else: ?>
          <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
              <td><?= (int)$row['appointment_id'] ?></td>
              <td>
                <?= htmlspecialchars($row['user_name']) ?><br>
                <small class="text-muted"><?= htmlspecialchars($row['user_email']) ?></small>
              </td>
              <td><?= htmlspecialchars($row['counsellor_name']) ?></td>
              <td><?= htmlspecialchars($row['appointment_date']) ?></td>
              <td><?= htmlspecialchars($row['appointment_time']) ?></td>
              <td style="max-width:300px; white-space:pre-wrap;"><?= htmlspecialchars($row['description']) ?></td>
              <td><?= htmlspecialchars($row['appointment_status']) ?></td>
              <td>
                <!-- status actions -->
                <div class="btn-group" role="group" aria-label="status">
                  <a href="status_update.php?appointment_id=<?= (int)$row['appointment_id'] ?>&status=Confirmed" class="btn btn-sm btn-outline-success">Confirm</a>
                  <a href="status_update.php?appointment_id=<?= (int)$row['appointment_id'] ?>&status=Cancelled" class="btn btn-sm btn-outline-warning">Cancel</a>
                  <a href="status_update.php?appointment_id=<?= (int)$row['appointment_id'] ?>&status=Completed" class="btn btn-sm btn-outline-primary">Complete</a>
                </div>
                <!-- delete -->
                <button class="btn btn-sm btn-outline-danger mt-1" onclick="deleteAppointment(<?= (int)$row['appointment_id'] ?>)"><i class="fa-solid fa-trash"></i></button>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- pagination -->
  <?php if ($totalPages > 1): ?>
  <nav>
    <ul class="pagination justify-content-end">
      <?php for ($p=1;$p<=$totalPages;$p++): ?>
      <li class="page-item <?= $p === $page ? 'active':'' ?>"><a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a></li>
      <?php endfor; ?>
    </ul>
  </nav>
  <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require '../layouts/master.php';

?>

<script>
function deleteAppointment(id) {
  Swal.fire({
    title: "Delete appointment?",
    text: "This will permanently delete the appointment.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete",
  }).then((r) => {
    if (r.isConfirmed) {
      window.location.href = "delete_appointment.php?appointment_id=" + id;
    }
  });
}
</script>