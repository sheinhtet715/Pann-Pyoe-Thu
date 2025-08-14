<?php
session_name('ADMINSESSID');
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
<style>
    /* Background */
    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Nunito', sans-serif;
        overflow: hidden;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #fff;
        animation: fadeIn 1s ease-in-out;
    }

    /* Input fields */
    .form-control {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: #fff;
    }
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Login button */
    .btn-primary {
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        border: none;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
    }
    .btn-primary:hover {
        box-shadow: 0 0 15px rgba(255, 126, 95, 0.8);
        transform: translateY(-2px);
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* Responsive logo + text */
.logo-container img {
    width: 70px;
    height: 70px;
    border-radius: 10px;
}
.logo-container h2 {
    font-weight: 700;
    color: white;
    font-size: 1.6rem;
}

/* Smaller screens */
@media (max-width: 576px) {
    .logo-container img {
        width: 55px;
        height: 55px;
    }
    .logo-container h2 {
        font-size: 1.3rem;
    }
    .p-5 {
        padding: 1.5rem !important;
    }
    .form-control {
        font-size: 0.9rem;
    }
    .btn-primary {
        font-size: 0.9rem;
    }
}

/* Medium screens */
@media (max-width: 768px) {
    .logo-container h2 {
        font-size: 1.4rem;
    }
}

</style>

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
                                    <div class="text-center mb-4 logo-container">
                                        <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu Logo">
                                        <h2 class="mt-2">Pann Pyoe Thu</h2>
                                    </div>


                                    <div class="text-center">
                                        <h1 class="h4 text-white-900 mb-4">Welcome Back!</h1>
                                    </div>

                                   <form class="user" method="POST" action="index.php">
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
                                       

                                    <hr>

                                  
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
