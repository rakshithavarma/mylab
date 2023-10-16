<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'virtual lab environment';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
    
    $cid=$_POST['classname'];
    mysqli_query($con, "DELETE FROM `classes` WHERE `id`= '$cid' ");
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if ($_SESSION["role"] == 2) {
            header("location: welcome-s.php");
        } elseif ($_SESSION["role"] == 1) {
            header("location: welcome-t.php");
        } elseif ($_SESSION["role"] == 3) {
            header("location: welcome.php");
        }
        exit;
    }
?>
                                    

