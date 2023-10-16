<?php
include("configclass.php");
$ct=$_POST['sectiontitle'];
mysqli_query($con, "INSERT INTO `sections` (`class_title`) VALUE ('$ct')");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome-a.php");
    exit;
}
?>