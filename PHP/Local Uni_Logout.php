<?php
session_start();
session_destroy();
header('Location: Local Uni.php');
exit;
?>