      
      <?php
session_name('ADMINSESSID');
session_start();

require '../database/db_connection.php'; 



?>
<?php ob_start(); ?>

  <div class="d-block d-md-none">
    <?php if (empty()): ?>
      <div class="text-center text-muted py-4">No Payment found.</div>
    <?php else: foreach ( as ):
        $id = 
    ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h6 class="mb-1">#<?= $id ?> — <?=  ?></h6>
              <div class="small text-muted"><?=  ?> • <?=  ?></div>
              <div class="mt-2">
              <span class="ms-3">


              </div>
            </div>
            <div class="text-end">
              <div class="mb-2">
                <span class="badge bg-info text-dark"></span>
              </div>

              <div class="btn-group-vertical" role="group" aria-label="mobile-actions">
                <a href=>Confirm</a>
                <a href=">Cancel</a>
                <a href=">Complete</a>
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
              <div class="small"><?= ?></div>
              <?php if (!empty($ ?>
                <hr>
                <div class="small"><strong>Requirement</strong><br><?= n ?></div>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>
  <!-- pagination -->


<?php
$content = ob_get_clean();
require '../layouts/master.php';
?>