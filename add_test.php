<?php
session_start();
$con = mysqli_connect("localhost","root","","virtual lab environment");

if(isset($_POST['save_datetime']))
{
    $name = $_POST['name'];
    $event_dt = $_POST['event_dt'];
    $class_id = $_SESSION["class_id"];
    $tid = $_SESSION["id"];
    $subject_id=$_SESSION["subject_id"];
    $sec_id = $_SESSION["section_id"];
    $query = "INSERT INTO tests (teacher_id,section_id,class_id,subject_id,question,subdatetime) VALUES ('$tid','$sec_id' ,'$class_id','$subject_id','$name','$event_dt')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        header("location: class_template-t.php?id=$class_id");
    }
    else
    {
        echo "Test Not Inserted. Error:-(";
        header("Location: class_template-t.php?id=$class_id");
    }
}
?>