<?php
$servername = "localhost";
$username = "janahani";
$password = "SecurePass123";
$DB = "ProFit-gym";

$conn = mysqli_connect($servername,$username,$password,$DB);


if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>