<?php


if (session_status() === PHP_SESSION_NONE) {
    session_name('ADMINSESSID');
    session_start();
}

require '../database/db_connection.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $stmt = $conn->prepare("SELECT * FROM user_tbl WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // <-- array, not string
} else {
    $user = null;
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
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
<style>
        /* ===== Sidebar Cool Style ===== */
/* ---------- Keep your original sidebar color; this augments effects ---------- */
#accordionSidebar {
  position: relative; /* for pseudo overlays */
  overflow: hidden;
  -webkit-font-smoothing: antialiased;
}

/* moving sheen/texture (very subtle) without changing base color */
#accordionSidebar::before{
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(115deg,
      rgba(255,255,255,0.02) 0%,
      rgba(255,255,255,0.00) 20%,
      rgba(0,0,0,0.02) 50%,
      rgba(255,255,255,0.00) 80%,
      rgba(255,255,255,0.02) 100%);
  transform: translateX(-25%);
  mix-blend-mode: overlay; /* keeps base color visible */
  animation: sidebar-sheen 8s linear infinite;
  transition: opacity .3s ease;
}

@keyframes sidebar-sheen {
  0%   { transform: translateX(-30%); }
  50%  { transform: translateX(30%);  }
  100% { transform: translateX(-30%); }
}

/* nav-link baseline - keep it clean and enable relative positioning for ripple */
#accordionSidebar .nav-link{
  position: relative;
  overflow: hidden;
  transition: transform .18s ease, box-shadow .18s ease, background-color .18s ease;
  border-radius: 6px;
}

/* subtle slide fill on hover (does not change base color) */
#accordionSidebar .nav-link::after{
  content: "";
  position: absolute;
  left: -10%;
  top: 0;
  height: 100%;
  width: 0%;
  pointer-events: none;
  background: linear-gradient(90deg,
      rgba(255,255,255,0.06) 0%,
      rgba(255,255,255,0.02) 40%,
      rgba(255,255,255,0.01) 60%,
      rgba(255,255,255,0.04) 100%);
  transition: width .36s cubic-bezier(.2,.9,.2,1), left .36s cubic-bezier(.2,.9,.2,1);
  mix-blend-mode: screen;
}

/* when user hovers the item the fill sweeps across */
#accordionSidebar .nav-item:hover .nav-link::after,
#accordionSidebar .nav-link:hover::after{
  left: 0;
  width: 100%;
}

/* hover micro-movement and shadow for depth (keeps color) */
#accordionSidebar .nav-item:hover .nav-link,
#accordionSidebar .nav-link:hover{
  transform: translateX(6px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.12), inset 0 -1px 0 rgba(255,255,255,0.02);
}

/* active / selected item styling (accent without changing bg color) */
#accordionSidebar .nav-link.active,
#accordionSidebar .nav-item.active .nav-link{
  box-shadow:
    inset 6px 0 18px rgba(255,255,255,0.03),
    0 10px 30px rgba(0,0,0,0.14);
  transform: translateX(2px);
}

/* click/press micro-feedback */
#accordionSidebar .nav-link:active{
  transform: translateX(2px) scale(0.997);
  transition: transform .08s ease;
}

/* icon glow on hover (you already had this — preserved and slightly tuned) */
#accordionSidebar .nav-item i {
  transition: color .25s ease, text-shadow .25s ease, transform .25s ease;
}
#accordionSidebar .nav-item:hover i {
  color: #fffa65; /* your yellow */
  text-shadow: 0 0 8px #fffa65;
  transform: translateX(2px) scale(1.02);
}

/* ---------- Ripple (click) visual ---------- */
.ripple {
  position: absolute;
  border-radius: 50%;
  transform: scale(0);
  animation: ripple-effect 600ms linear;
  background: rgba(255,255,255,0.18);
  pointer-events: none;
}
@keyframes ripple-effect {
  to {
    transform: scale(4);
    opacity: 0;
  }
}

/* ---------- Topbar subtle effect (keeps bg-white) ---------- */
.topbar {
  position: relative;
  overflow: hidden;
}

/* small diagonal sheen on topbar (low opacity so white remains) */
.topbar::before {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(90deg, rgba(0,0,0,0.02), rgba(255,255,255,0.03), rgba(0,0,0,0.02));
  transform: translateX(-15%);
  mix-blend-mode: overlay;
  animation: topbar-sheen 12s linear infinite;
}
@keyframes topbar-sheen {
  0% { transform: translateX(-20%); }
  50% { transform: translateX(20%); }
  100% { transform: translateX(-20%); }
}

/* dropdown menu - subtle lift and soft shadow */
.dropdown-menu {
  transition: transform .16s cubic-bezier(.2,.9,.2,1), opacity .16s ease;
  transform-origin: top right;
}
.dropdown.show .dropdown-menu {
  transform: translateY(6px) scale(1.01);
  box-shadow: 0 14px 40px rgba(0,0,0,0.12);
}
.dropdown-item:hover {
  background: rgba(0,0,0,0.03);
}

/* small accessibility focus ring (visible on keyboard nav) */
#accordionSidebar .nav-link:focus,
.topbar .nav-link:focus {
  outline: 3px solid rgba(255,255,255,0.06);
  outline-offset: 2px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.12);
}

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul style="background-color: rgb(83, 153, 160);" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                     <img src="../../HomePimg/Logo.ico" style="width: 40px" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">Pann Pyoe Thu</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../dashboard/main.php"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../Counsellor/list.php"><i class="fa-solid fa-person"></i><span>Counsellors </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../Scholarships/list.php"><i class="fa-solid fa-plus"></i></i><span>Scholarships </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../Jobs/list.php"><i class="fa-solid fa-layer-group"></i><span>Jobs</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="../Courses/list.php"><i class="fa-solid fa-book"></i><span>Courses </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../Users/userlist.php"><i class="fa-solid fa-list"></i><span>User List</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../Appointment_lists/appoinment.php"><i class="fa-solid fa-calendar-check"></i><span>Appoinment Lists </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../changepassword/changepassword.php"><i class="fa-solid fa-lock"></i></i></i><span>Change Password </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../changepassword/profile.php"><i class="fa-solid fa-user"></i><span>Profile </span></a>
            </li>

            <li class="nav-item">
                <form action="../logout.php" method="post">

                    <span class="nav-link">
                        <button type="submit" class="btn bg-dark text-white"><i
                                class="fa-solid fa-right-from-bracket"></i> Logout</button>
                    </span>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: white">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                     
                       <?php if (!empty($user) && is_array($user)): ?>
                            <p class="mt-2 mr-2" ><?php echo htmlspecialchars($user['user_name']); ?></p>
                        <?php else: ?>
                            <p class="mt-2 mr-2">Guest</p>
                        <?php endif; ?>
                     <?php if ($user['profile_path']): ?>
                        <img src="../../<?php echo htmlspecialchars($user['profile_path']) ?>" alt="Profile"  style="width:40px; height:40px; object-fit:cover;" class="rounded-circle">
                        <?php else: ?>
                        <img src="../uploads/1000_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" alt="Profile"  style="width:40px; height:40px; object-fit:cover;" class="rounded-circle">
                        <?php endif; ?>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                    <?= $content ?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                    <!-- Bootstrap core JavaScript-->
                    <script src="'admin/vendor/jquery/jquery.min.js'"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script src="'../vendor/bootstrap/js/bootstrap.bundle.min.js'"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="'../vendor/jquery-easing/jquery.easing.min.js'"></script>
                    <!-- Custom scripts for all pages-->
                    <script src="'../js/sb-admin-2.min.js'"></script>


                    <script src="'../vendor/chart.js/Chart.min.j's"></script>

                    <!-- Page level custom scripts -->
                    <script src="'../js/demo/chart-area-demo.js'"></script>
                    <script src="'../js/demo/chart-pie-demo.js'"></script>


</body>

</html>