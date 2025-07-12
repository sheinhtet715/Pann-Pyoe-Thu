<?php
$servername = "localhost";
$user = "root";
$db_password = "";
$db_name = "pannpyoethudb";
$conn = new mysqli($servername, $user, $db_password, $db_name);

if ($conn -> connect_error){
    die("Connection failed".$conn -> connect_error);
}
echo "";

?>