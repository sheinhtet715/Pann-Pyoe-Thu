<?php
session_start();
session_destroy();
header('Location: About Us.php');
exit;
