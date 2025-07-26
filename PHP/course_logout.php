<?php
session_start();
session_destroy();
header('Location: Courses.php');
exit;