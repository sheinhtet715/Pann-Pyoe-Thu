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
                    <div class=" d-flex justify-content-between my-2 align-items-center">
                        <div class="">
                         <button class="btn btn-secondary"><i class="fa-solid fa-calendar-check"></i> Appointment Count (<?= (int)$total ?>)</button>
                            
                        </div>

                        <div class="col-auto" style="max-width:360px;">
                            <form method="get">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search by user, counsellor, date..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                                <button class="btn bg-dark text-white" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>

                        <div class="table-responsive">
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
  <?php while ($row = $res->fetch_assoc()):
        $id = (int)$row['appointment_id'];
        // create a short single-line preview (safe and trimmed)
        $preview = htmlspecialchars(mb_strimwidth(trim((string)($row['description'] ?? '')), 0, 90, '...'));
  ?>
    <!-- MAIN ROW: compact table view -->
    <tr class="main-row">
      <td><?= $id ?></td>

      <td>
        <?= htmlspecialchars($row['user_name']) ?><br>
        <small class="text-muted"><?= htmlspecialchars($row['user_email']) ?></small>
      </td>

      <td><?= htmlspecialchars($row['counsellor_name']) ?></td>
      <td><?= htmlspecialchars($row['appointment_date']) ?></td>
      <td><?= htmlspecialchars($row['appointment_time']) ?></td>

      <!-- short preview + toggle -->
      <td style="vertical-align: middle;">
        <div class="d-inline-block text-truncate" style="max-width:260px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
          <?= $preview ?>
        </div>
        <a class="btn btn-sm btn-link p-0 ms-2" 
           data-bs-toggle="collapse" 
           href="#desc-<?= $id ?>" 
           role="button" 
           aria-expanded="false" 
           aria-controls="desc-<?= $id ?>">
          Show
        </a>
      </td>

      <td><?= htmlspecialchars($row['appointment_status']) ?></td>

      <td>
        <div class="btn-group" role="group" aria-label="status">
          <a href="status_update.php?appointment_id=<?= $id ?>&status=Confirmed" class="btn btn-sm btn-outline-success">Confirm</a>
          <a href="status_update.php?appointment_id=<?= $id ?>&status=Cancelled" class="btn btn-sm btn-outline-warning">Cancel</a>
          <a href="status_update.php?appointment_id=<?= $id ?>&status=Completed" class="btn btn-sm btn-outline-primary">Complete</a>
        </div>
        
        <button class="btn btn-sm btn-outline-danger mt-1" onclick="deleteAppointment(<?= $id ?>)">
          <i class="fa-solid fa-trash"></i>
        </button>
      </td>
    </tr>

    <!-- DETAIL ROW: hidden, shows when the collapse is opened -->
    <tr class="detail-row">
      <td colspan="8" class="p-0">
        <div class="collapse" id="desc-<?= $id ?>">
          <div class="p-3 bg-light border">
            <div class="d-flex justify-content-between">
              <strong>Description</strong>
              <div>
                <a class="btn btn-sm btn-outline-secondary"
                   data-bs-toggle="collapse"
                   href="#desc-<?= $id ?>">Close</a>
              </div>
            </div>

            <div class="mt-2"><?= nl2br(htmlspecialchars($row['description'] ?? '')) ?></div>

            <?php if (!empty($row['requirement'])): ?>
              <hr>
              <strong>Requirement</strong>
              <div class="mt-2"><?= nl2br(htmlspecialchars($row['requirement'])) ?></div>
            <?php endif; ?>
          </div>
        </div>
      </td>
    </tr>

  <?php endwhile; ?>
<?php endif; ?>
</tbody>

    </table>
  </div>
            </div>
  <!-- CARD VIEW for mobile (smaller screens) -->
  <div class="d-block d-md-none">
    <?php if (empty($appointments)): ?>
      <div class="text-center text-muted py-4">No appointments found.</div>
    <?php else: foreach ($appointments as $row):
        $id = (int)$row['appointment_id'];
    ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h6 class="mb-1">#<?= $id ?> — <?= htmlspecialchars($row['user_name']) ?></h6>
              <div class="small text-muted"><?= htmlspecialchars($row['user_email']) ?> • <?= htmlspecialchars($row['counsellor_name']) ?></div>
              <div class="mt-2">
                <strong>Date:</strong> <?= htmlspecialchars($row['appointment_date']) ?>
                <span class="ms-3"><strong>Time:</strong> <?= htmlspecialchars($row['appointment_time']) ?></span>
              </div>
            </div>
            <div class="text-end">
              <div class="mb-2">
                <span class="badge bg-info text-dark"><?= htmlspecialchars($row['appointment_status']) ?></span>
              </div>

              <div class="btn-group-vertical" role="group" aria-label="mobile-actions">
                <a href="status_update.php?appointment_id=<?= $id ?>&status=Confirmed" class="btn btn-sm btn-outline-success mb-1">Confirm</a>
                <a href="status_update.php?appointment_id=<?= $id ?>&status=Cancelled" class="btn btn-sm btn-outline-warning mb-1">Cancel</a>
                <a href="status_update.php?appointment_id=<?= $id ?>&status=Completed" class="btn btn-sm btn-outline-primary mb-1">Complete</a>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteAppointment(<?= $id ?>)"><i class="fa-solid fa-trash"></i></button>
              </div>
            </div>
          </div>

          <hr>

          <div>
            <div class="d-flex justify-content-between align-items-center">
              <div class="small text-muted">Notes</div>
              <a class="btn btn-sm btn-link" data-bs-toggle="collapse" href="#mob-desc-<?= $id ?>">Details</a>
            </div>

            <div class="collapse mt-2" id="mob-desc-<?= $id ?>">
              <div class="small"><?= nl2br(htmlspecialchars($row['description'] ?? '')) ?></div>
              <?php if (!empty($row['requirement'])): ?>
                <hr>
                <div class="small"><strong>Requirement</strong><br><?= nl2br(htmlspecialchars($row['requirement'])) ?></div>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    <?php endforeach; endif; ?>
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