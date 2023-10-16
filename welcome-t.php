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
        $tid = $_SESSION["id"];
        $sql = "SELECT * FROM `classes` WHERE `teacher_id` = $tid;";
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $sec_id = $row['section_id'];
        ?>
                <div class="card mb-3 pb-4 classroomcard">
                    <img class="classroomcard" src="<?= $row['thumbnail'] ?>" width="253" height="140" class="img-polaroid" alt="">
                    <div class="card-body">
                        <a href="class_template-t.php<?php echo '?id=' . $id; ?>">
                            <h5 class="card-title">
                                <?php echo $row['subject_title']; ?> Lab -
                                <?php echo $row['section']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $row['code']; ?>
                            </p>
                        </a><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $id ?>">
                            <i class="fa fa-trash">Remove Class</i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove Lab</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you really want to remove <?php echo $row['subject_title']; ?> Lab -
                                        <?php echo $row['section']; ?>
                                        <form action="removeclass.php" method="post">
                                            <input type="text" name="classname" id="" value="<?php echo $id ?>" style="display: none;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <input type="submit" class="btn btn-primary" name="removeclass" id="removeclass" value="Remove Lab">
                                        <script>
                                            $(document).ready(function() {
                                                $("#removeclass").click(function() {
                                                    // AJAX Code To Submit Form.
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "removeclass.php",
                                                        cache: false
                                                    });
                                                });
                                            });
                                        </script>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            <?php }
        } else { ?>
            <div class="alert alert-info"><i class="icon-info-sign"></i> No Class Currently Added</div>
        <?php } ?>


        <div class="card mb-4 pb-4 classroomcard">
            <img class="classroomcard" src="images/add_bttn.png" width="256" height="140" alt="Avatar" style="width:100%">
            <div class="container">
                <!-- Trigger the modal with a button -->
                <i class=""></i>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="margin-left: 50px;margin-right: auto;">Create Lab</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Create Lab</h4>
                            </div>
                            <div class="modal-body">
                                <form action="createclass.php" method="post">
                                    <label for="">Select Subject</label>
                                    <select name="csubject" required  style="padding: 4px;">
                                        <option value=""></option>
                                        <?php
                                        $query = mysqli_query($con, "select * from subjects");
                                        while ($row = mysqli_fetch_array($query)) {

                                        ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['title']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <br>
                                    <br>
                                    <label for="">Select Section</label>
                                    <br>
                                    <select name="csection" required style="padding: 4px; padding-right: 14vw!important;">
                                        <option value=""></option>
                                        <?php
                                        $query = mysqli_query($con, "select * from sections");
                                        while ($row = mysqli_fetch_array($query)) {

                                        ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['class_title']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" id="createclass" value="Create Lab">
                                <script>
                                    $(document).ready(function() {
                                        $("#createclass").click(function() {
                                            // AJAX Code To Submit Form.
                                            $.ajax({
                                                type: "POST",
                                                url: "createclass.php",
                                                cache: false
                                            });
                                        });
                                    });
                                </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("chatbot_index.php");?>
</body>

</html>