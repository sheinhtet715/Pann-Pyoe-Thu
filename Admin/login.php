<?php
    session_start();
// adjust this to point at your real file location:
include './database/db_connection.php';

// 2) Now $conn is defined, so we can use it:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email && $password) {
        $stmt = $conn->prepare("
            SELECT user_id, password_hash, role
              FROM User_tbl
             WHERE email = ?
             LIMIT 1
        ");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $hash, $role);
            $stmt->fetch();

            // ←– compare MD5s instead of password_verify
            if (md5($password) === $hash) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role']    = $role;

                // if login.php is in your project root, this will point into dashboard/
                header("Location: dashboard/main.php");
                exit;
            }
        }

        $error = "Invalid email or password.";
    } else {
        $error = "Please fill in both fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top " >

    <div class="container">
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8 offset-2">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                   <form class="user" method="POST" action="login.php">
                                        <div class="form-group">
                                        <input type="email"
                                                class="form-control form-control-user"
                                                name="email"
                                                placeholder="Enter Email Address..."
                                                required>
                                        </div>
                                        <div class="form-group">
                                        <input type="password"
                                                class="form-control form-control-user"
                                                name="password"
                                                placeholder="Password"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                        </button>
                                    </form>
                                        <!-- <a href="" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="" class="btn btn-facebook btn-user bg-dark btn-block">
                                            <i class="fa-brands fa-github fa-fw"></i> Login with Github
                                        </a> -->

                                    <hr>

                                    <!-- <div class="text-center">
                                        <a class="small" href="">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="'admin/vendor/jquery/jquery.min.js'"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="'admin/vendor/bootstrap/js/bootstrap.bundle.min.js'"></script>

    <!-- Core plugin JavaScript-->
    <script src="'admin/vendor/jquery-easing/jquery.easing.min.js'"></script>

    <!-- Custom scripts for all pages-->
    <script src="'admin/js/sb-admin-2.min.js'"></script>


    <script src="'admin/vendor/chart.js/Chart.min.j's"></script>

    <!-- Page level custom scripts -->
    <script src="'admin/js/demo/chart-area-demo.js'"></script>
    <script src="'admin/js/demo/chart-pie-demo.js'"></script>


</body>

</html>
