<?php
$servername = 'localhost';
$username = 'id14770569_root';
$password = 'Suyash@12345';
$dbname = 'id14770569_task';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die('Connection Failed: '.mysqli_connect_error());
}
?>