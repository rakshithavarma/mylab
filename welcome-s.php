<?php

// Initialize the session
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'virtual lab environment';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the user is logged in, if not then redirect him to login page
include("setsession.php");


$username = $_SESSION["username"];
$sql = "SELECT `section` FROM `students` WHERE `username` = '$username'";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
$section = $row['section'];

$_SESSION['class_id'] = "";
$_SESSION['section_id'] = "";
$_SESSION["subject_id"] = "";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="style1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <?php include("navtopwelcome.php"); ?>
    <div class="content" style="margin-top:100px;">
        <p>Welcome back, <?= $_SESSION['username'] ?>!</p>
    </div>
    <div class="card-columns mb-4 ">
        <?php
        $sql = "SELECT * FROM `classes` WHERE `section` = '$section';";
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $sec_id = $row['section_id'];
        ?>
                <div class="card mb-3 pb-4 classroomcard">
                    <img class="classroomcard" src="<?= $row['thumbnail'] ?>" width="256" height="140" class="img-polaroid" alt="">
                    <div class="card-body">
                        <a href="class_template-t.php<?php echo '?id=' . $id; ?>">
                            <h5 class="card-title">
                                <?php echo $row['subject_title']; ?> Lab -
                                <?php echo $row['section']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $row['code']; ?>
                            </p>
                        </a>

                    </div>

                </div>


            <?php }
        } else { ?>
            <div class="alert alert-info"><i class="icon-info-sign"></i> No Class Currently Added</div>
        <?php } ?>


    </div>
    
    <?php include("chatbot_index.php");?>
</body>

</html>