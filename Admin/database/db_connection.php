<?php
//DB connection
$servername = "localhost";
$user = "root";
$db_password = "";
$db_name = "pannpyoethudb";
$conn = new mysqli($servername, $user, $db_password, $db_name);

if ($conn -> connect_error){
    die("Connection failed".$conn -> connect_error);
}
echo "";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8mb4", $user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


?>