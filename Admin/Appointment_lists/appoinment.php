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
/** ---------- paste function here (before any output) ---------- */
if (!function_exists('format_ampm_time')) {
  function format_ampm_time($timeRaw, $dotStyle = 'dots') {
    $time = trim((string)$timeRaw);
    if ($time === '') return '-';
    $t = preg_replace('/\.(?=[ap]m)/i', '', $time);
    $t = preg_replace('/[,]+/', ' ', $t);
    $t = preg_replace('/\s+/', ' ', $t);
    $t = strtolower($t);
    $t = preg_replace('/([0-9])([ap]m)$/', '$1 $2', $t);
    $t = preg_replace('/^\d{3,4}$/', '$0', $t); // keep; function will accept 1530 -> handled below
    if (preg_match('/^\d{3,4}$/', $t)) {
      if (strlen($t) === 3) $t = substr($t,0,1) . ':' . substr($t,1,2);
      else $t = substr($t,0,2) . ':' . substr($t,2,2);
    }
    if (preg_match('/^(\d{2})(\d{2})(\d{2})$/', $t, $m)) $t = $m[1] . ':' . $m[2] . ':' . $m[3];
    $ts = strtotime($t);
    if ($ts === false) {
      if (preg_match('/^(\d{1,2}):(\d{2})(?::\d{2})?(?:\s*(am|pm))?$/i', $t, $m)) {
        $hour = (int)$m[1]; $min = (int)$m[2]; $ampm = $m[3] ?? null;
        if ($ampm === 'pm' && $hour < 12) $hour += 12;
        if ($ampm === 'am' && $hour === 12) $hour = 0;
        $dt = new DateTimeImmutable(); $dt = $dt->setTime($hour,$min);
        $ts = $dt->getTimestamp();
      } elseif (preg_match('/^(\d{1,2})(?:\s*(am|pm))$/i', $t, $m)) {
        $hour = (int)$m[1]; $ampm = strtolower($m[2]);
        if ($ampm === 'pm' && $hour < 12) $hour += 12;
        if ($ampm === 'am' && $hour === 12) $hour = 0;
        $dt = new DateTimeImmutable(); $dt = $dt->setTime($hour,0);
        $ts = $dt->getTimestamp();
      }
    }
    if ($ts === false || $ts === -1) return htmlspecialchars($timeRaw, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $out = date('g:i a', $ts);
    if ($dotStyle === 'dots') $out = str_replace(['am','pm'], ['a.m.','p.m.'], $out);
    elseif ($dotStyle === 'nodots') $out = str_replace(['am','pm'], ['a.m','p.m'], $out);
    return $out;
  }
}
/** ---------- end function ---------- */
// pagination & search
$limit = 4;
$page  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$q = trim((string)($_GET['q'] ?? ''));
$hasSearch = $q !== '';
$like = "%$q%";

// COUNT (respect search)
if ($hasSearch) {
    $countSql = "
      SELECT COUNT(*) FROM Appointment_tbl a
      JOIN User_tbl u ON a.user_id = u.user_id
      JOIN Counsellor_tbl c ON a.counsellor_id = c.counsellor_id
      WHERE u.user_name LIKE ? OR u.email LIKE ? OR c.counsellor_name LIKE ? OR a.appointment_date LIKE ?
    ";
    $countStmt = $conn->prepare($countSql);
    $countStmt->bind_param('ssss', $like, $like, $like, $like);
} else {
    $countSql = "
      SELECT COUNT(*) FROM Appointment_tbl a
      JOIN User_tbl u ON a.user_id = u.user_id
      JOIN Counsellor_tbl c ON a.counsellor_id = c.counsellor_id
    ";
    $countStmt = $conn->prepare($countSql);
}
$countStmt->execute();
$countStmt->bind_result($total);
$countStmt->fetch();
$countStmt->close();

$totalPages = max(1, ceil($total / $limit));

// MAIN SELECT (respect search & pagination)
if ($hasSearch) {
    $sql = "
      SELECT a.*, u.user_name, u.email as user_email, c.counsellor_name
      FROM Appointment_tbl a
      JOIN User_tbl u ON a.user_id = u.user_id
      JOIN Counsellor_tbl c ON a.counsellor_id = c.counsellor_id
      WHERE u.user_name LIKE ? OR u.email LIKE ? OR c.counsellor_name LIKE ? OR a.appointment_date LIKE ?
      ORDER BY a.appointment_date DESC, a.appointment_time DESC
      LIMIT ? OFFSET ?
    ";
    $stmt = $conn->prepare($sql);
    // 4 strings then 2 ints: ssssii
    $stmt->bind_param('ssssii', $like, $like, $like, $like, $limit, $offset);
} else {
    $sql = "
      SELECT a.*, u.user_name, u.email as user_email, c.counsellor_name
      FROM Appointment_tbl a
      JOIN User_tbl u ON a.user_id = u.user_id
      JOIN Counsellor_tbl c ON a.counsellor_id = c.counsellor_id
      ORDER BY a.appointment_date DESC, a.appointment_time DESC
      LIMIT ? OFFSET ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $limit, $offset);
}

$stmt->execute();
$res = $stmt->get_result();
?>

<?php ob_start(); ?>
                <div class="container py-4">
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

                         <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
                            <table class="table table-hover ">
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
</div>
<?php if ($res->num_rows === 0): ?>
  <tr><td colspan="8" class="text-center">No appointments found.</td></tr>
<?php else: ?>
  <?php while ($row = $res->fetch_assoc()):
        $id = (int)$row['appointment_id'];
        // create a short single-line preview (safe and trimmed)
        $preview = htmlspecialchars(mb_strimwidth(trim((string)($row['description'] ?? '')), 0, 20, '...'));
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
      <td><?= format_ampm_time($row['appointment_time']) ?></td>


      <!-- short preview + toggle -->
       <td style="vertical-align: middle;">
  <?php
    $fullDesc = trim((string)($row['description'] ?? ''));
    $threshold = 20; // same as preview length
    $needsToggle = mb_strwidth($fullDesc) > $threshold;
    $previewText = htmlspecialchars(mb_strimwidth($fullDesc, 0, $threshold, '...'));
  ?>
  <div class="d-inline-block text-truncate" style="max-width:260px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
    <?= $previewText ?>
  </div>

  <?php if ($needsToggle): ?>
    <a class="btn btn-sm btn-link p-0 ms-2 desc-toggle"
       data-bs-toggle="collapse"
       href="#desc-<?= $id ?>"
       role="button"
       aria-expanded="false"
       aria-controls="desc-<?= $id ?>">
      Show
    </a>
  <?php endif; ?>
</td>


      <td><?= htmlspecialchars($row['appointment_status']) ?></td>

      <td>
  <div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
            id="statusDropdown<?= $id ?>" data-bs-toggle="dropdown" aria-expanded="false">
      Change status
    </button>
    <ul class="dropdown-menu" aria-labelledby="statusDropdown<?= $id ?>">
      <li>
        <a class="dropdown-item" href="status_update.php?appointment_id=<?= $id ?>&status=Confirmed">
          Confirm
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="status_update.php?appointment_id=<?= $id ?>&status=Cancelled">
          Cancel
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="status_update.php?appointment_id=<?= $id ?>&status=Completed">
          Complete
        </a>
      </li>
    </ul>
  </div>

  <button class="btn btn-sm btn-outline-danger mt-1" onclick="deleteAppointment(<?= $id ?>)">
    <i class="fa-solid fa-trash"></i>
  </button>
</td>

    </tr>

    <!-- DETAIL ROW: hidden, shows when the collapse is opened -->
    <!-- DETAIL ROW: hidden, shows when the collapse is opened -->
<tr class="detail-row">
  <td colspan="8" class="p-0">
    <div class="collapse" id="desc-<?= $id ?>">
      <div class="p-3 bg-light border">
        <strong>Description</strong>
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
              <span class="ms-3"><strong>Time:</strong> <?= format_ampm_time($row['appointment_time']) ?></span>


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
              <a class="btn btn-sm btn-link desc-toggle" data-bs-toggle="collapse" href="#mob-desc-<?= $id ?>">Details</a>

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
</div>
  <!-- pagination -->
<?php if ($totalPages > 1): ?>
<nav>
  <ul class="pagination justify-content-end mt-5">
    <?php for ($p = 1; $p <= $totalPages; $p++): 
      $active = $p === $page ? 'active' : '';
      // preserve q
      $qs = $q !== '' ? '&q=' . urlencode($q) : '';
    ?>
      <li class="page-item <?= $active ?>">
        <a class="page-link" href="?page=<?= $p . $qs ?>"><?= $p ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>



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
<script>
document.addEventListener('DOMContentLoaded', function () {
  // For each toggle link, set initial text and bind show/hide events on its target.
  document.querySelectorAll('.desc-toggle').forEach(function (toggle) {
    var targetSelector = toggle.getAttribute('href');
    if (!targetSelector) return;
    var target = document.querySelector(targetSelector);
    if (!target) return;

    // initial state
    toggle.textContent = target.classList.contains('show') ? 'Hide' : 'Show';
    toggle.setAttribute('aria-expanded', target.classList.contains('show') ? 'true' : 'false');

    // when collapse is shown -> set all toggles for that collapse to "Hide"
    target.addEventListener('show.bs.collapse', function () {
      document.querySelectorAll('.desc-toggle[href="' + targetSelector + '"]').forEach(function (t) {
        t.textContent = 'Hide';
        t.setAttribute('aria-expanded', 'true');
      });
    });

    // when collapse is hidden -> set all toggles for that collapse to "Show"
    target.addEventListener('hide.bs.collapse', function () {
      document.querySelectorAll('.desc-toggle[href="' + targetSelector + '"]').forEach(function (t) {
        t.textContent = 'Show';
        t.setAttribute('aria-expanded', 'false');
      });
    });
  });
});
</script>

