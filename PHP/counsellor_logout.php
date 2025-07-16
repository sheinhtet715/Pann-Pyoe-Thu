<?php
session_start();
session_destroy();
header('Location: Counsellor.php');
exit;
