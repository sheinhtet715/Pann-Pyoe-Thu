<?php
session_name('ADMINSESSID');
session_start();
require '../database/db_connection.php';

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$searchKey = $_GET['searchKey'] ?? '';

// Prepare base SQL with JOINs for course and job names
$sql = "
    SELECT u.*, c.course_name, j.job_title
    FROM User_tbl u
    LEFT JOIN course_tbl c ON u.course_id = c.course_id
    LEFT JOIN job_tbl j ON u.job_id = j.job_id
";

// Parameters for query
$params = [];
$types = '';

if ($searchKey) {
    $sql .= " WHERE u.user_id = ? OR u.user_name LIKE ? OR u.email LIKE ? OR u.phone LIKE ?";
    $params[] = (int)$searchKey; // for user_id exact match
    $params[] = "%$searchKey%";
    $params[] = "%$searchKey%";
    $params[] = "%$searchKey%";
    $types = 'isss';
}

$sql .= " ORDER BY u.user_id DESC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$types .= 'ii';

// Prepare total count query for pagination & user count
$countSql = "SELECT COUNT(*) FROM User_tbl";
$countParams = [];
$countTypes = '';
if ($searchKey) {
    $countSql .= " WHERE user_id = ? OR user_name LIKE ? OR email LIKE ? OR phone LIKE ?";
    $countParams = [(int)$searchKey, "%$searchKey%", "%$searchKey%", "%$searchKey%"];
    $countTypes = 'isss';
}

$stmtCount = $conn->prepare($countSql);
if ($searchKey) {
    $stmtCount->bind_param($countTypes, ...$countParams);
}
$stmtCount->execute();
$stmtCount->bind_result($totalUsers);
$stmtCount->fetch();
$stmtCount->close();

// Prepare main query
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();

?>
<?php


$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<?php ob_start(); ?>



                <div class="container">
                    <div class=" d-flex justify-content-between my-2">
                        <div class="">
                          
                            <button class="btn btn-secondary rounded shadow-sm">
                                <i class="fa-solid fa-database"></i> User Count (<?= $totalUsers ?>)
                            </button>
                                
                        </div>
                        <div class="">
                            <form action="" method="get">

                   
                           
                <div class="input-group">
                    <input type="text" name="searchKey" value="<?= htmlspecialchars($searchKey) ?>" class="form-control" placeholder="Search by ID, name, email, phone...">
                    <button type="submit" class="btn bg-dark text-white">
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
                        <th>Profile Image</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Job</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows === 0): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">No users found.</td>
                        </tr>
                    <?php else: ?>
                        <?php while ($user = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php if ($user['profile_path']): ?>
                                        <img src="../../<?= htmlspecialchars($user['profile_path']) ?>" alt="Profile" class="img-thumbnail rounded shadow-sm" style="width:100px; height:100px; object-fit:cover;">
                                    <?php else: ?>
                                        <img src="./1000_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" alt="No profile" class="img-thumbnail rounded shadow-sm" style="width:100px; height:100px; object-fit:cover;">
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($user['user_id']) ?></td>
                                <td><?= htmlspecialchars($user['user_name']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['phone'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($user['course_name'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($user['job_name'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($user['role'] ?? '-') ?></td>
                                <td>
                           <?php if (!($user['role'] === 'admin')): ?>
                            <button type="button" onclick="deleteUser(<?= $user['user_id'] ?>)" class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        <?php else: ?>
                            <button type="button" class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="fa-solid fa-ban"></i>
                            </button>
                        <?php endif; ?>

                            </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php
            $totalPages = ceil($totalUsers / $limit);
            if ($totalPages > 1): ?>
            <nav>
                <ul class="pagination justify-content-end">
                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                        <li class="page-item <?= $p == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $p ?>&searchKey=<?= urlencode($searchKey) ?>"><?= $p ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require '../layouts/master.php';

?>
<script>
function deleteUser(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This user record will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted!",
                text: "The user has been deleted.",
                icon: "success",
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "delete_user.php?id=" + id;
            });
        }
    });
}
</script>
