<?php

// Initialize the session
include("configclass.php");

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

<body class="loggedin" style="max-width: 100vw;">
    <?php include("navtopwelcome.php"); ?>
    <div class="content">
        <h2>Home Page</h2>
        <p>Welcome back, <?= $_SESSION['username'] ?>!</p>
    </div>
    <div class="container">
        <div class="card mb-3 pb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subModal">
                Create Subject
            </button>

            <!-- Modal -->
            <div class="modal fade" id="subModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="welcome-a.php" method="post" enctype="multipart/form-data">

                                <input type="text" name="title" id="">
                                <input type="text" name="code" id="">
                                Select File to Upload:
                                <input type="file" name="file">



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" class="btn btn-primary" value="Upload">
                            </form>
                            <?php
                            error_reporting(0);
                            include("dbConfig.php");


                            //file upload path
                            $targetDir = "images/";
                            $fileName = basename($_FILES["file"]["name"]);
                            $targetFilePath = $targetDir . $fileName;
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                            $code = $_POST["code"];
                            $title = $_POST["title"];

                            if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
                                //allow certain file formats
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                                if (in_array($fileType, $allowTypes)) {
                                    //upload file to server
                                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                                        $insert = $db->query("INSERT INTO subjects (title,code,thumbnail) VALUES ('$title' ,  '$code','" . $targetDir . $fileName . "')");
                                    } else {
                                    }
                                } else {
                                }
                            } else {
                            }    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3 pb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#secModal">
                Create Section
            </button>

            <!-- Modal -->
            <div class="modal fade" id="secModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="createSection.php" method="post">
                                <label for=sect"">Section</label>
                                <input type="text" name="sectiontitle" id="sect"></input>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="createSection" id="createSection" value="Create Section">
                            <script>
                                $(document).ready(function() {
                                    $("#createSection").click(function() {
                                        // AJAX Code To Submit Form.
                                        $.ajax({
                                            type: "POST",
                                            url: "createSection.php",
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
    
    <?php include("chatbot_index.php");?>
</body>

</html>