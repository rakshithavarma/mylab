<!DOCTYPE html>
<html>

<head>
    <title>
        Compiler
    </title>
    <link rel="stylesheet" href="style.css">
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body class="loggedin">
    <?php include("navtopwelcome.php"); ?>
    <?php
    session_start();
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'virtual lab environment');

    /* Attempt to connect to MySQL database */
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($db === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $url_id = $_SESSION['class_id'];
    $asgn_id = $_SESSION['asgn_id']
    ?>

    <html>

    <body>
        <form action="code_playgroundf2.php" method="POST">
            <input type="submit" name="start" value="Start" style="display:none" class="btn btn-primary">
            <br><br>
            <input id="dispupload" type="submit" name="end" value="End" class="btn btn-primary" onclick="displayupload()">
        </form>
        <script>
            function displayupload() {
                document.getElementsByID.style.display = "none";
            }
        </script>
        <?php

        if (isset($_POST['start'])) {
            date_default_timezone_set('Asia/Calcutta');
            $time_start = date("Y-m-d h:i:s ");
            $_SESSION['start'] = $time_start;
        }

        if (isset($_POST['end'])) {
            date_default_timezone_set('Asia/Calcutta');
            $time_end = date("Y-m-d h:i:s ");
            $_SESSION['end'] = $time_end;
        }
        ?>

        <script>
            SEC_HTTPS = true;
            SEC_BASE = "compilers.widgets.sphere-engine.com";
            (function(d, s, id) {
                SEC = window.SEC || (window.SEC = []);
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = (SEC_HTTPS ? "https" : "http") + "://" + SEC_BASE + "/static/sdk/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "sphere-engine-compilers-jssdk"));
        </script>
        <div id="codepen">

            <div class="sec-widget" data-widget="91e9db5da17762311a7ccdb996f6db55"></div>
        </div>

        <?php
        // Include the database configuration file
        error_reporting(0);
        include 'dbConfig.php';
        $statusMsg = '';

        $stud_id = $_SESSION['id'];
        $class_id = $_SESSION['class_id'];
        $asgn_id = $_SESSION['asgn_id'];

        $sst = new DateTime($_SESSION['start']);
        $eet = new DateTime($_SESSION['end']);
        $diff = date_diff($eet, $sst);
        $sst1 = $sst->format("Y-m-d h:i:s");
        $eet1 = $eet->format("Y-m-d h:i:s");
        $diff1 = $diff->format("Y-m-d h:i:s");
        $timeelapsed = $diff->format("%h:%i:%s");


        // File upload path
        $targetDir = "assignments_submissions/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'ppt', 'docx', 'txt');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name into database
                    $insert = $db->query("INSERT into assignment_submissions (stud_id,class_id,asgn_id,sst,eet,diff,file_name, uploaded_on) VALUES ('$stud_id','$class_id','$asgn_id','$sst1', '$eet1', '$timeelapsed','" . $fileName . "', NOW())");
                    if ($insert) {
                        $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    } else {
                        $statusMsg = "File upload failed, please try again.";
                    }
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
        } else {
            $statusMsg = '';
        }

        // Display status message
        echo $statusMsg;
        ?>
        <form action="code_playgroundf.php" method="post" enctype="multipart/form-data" style="display: none;">
            Select File to Upload:
            <input type="file" name="file">
            <input type="submit" name="submit" value="Upload">
        </form>
        
    </body>

    </html>