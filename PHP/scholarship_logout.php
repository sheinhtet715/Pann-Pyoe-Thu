<?php
session_start();
session_destroy();
header('Location: Scholarship.php');
exit;
