<?php
session_start();
session_destroy();
header('Location: jobs.php');
exit;