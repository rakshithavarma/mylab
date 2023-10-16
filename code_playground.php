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
    include("extractAsgnID.php");

    ?>

    <html>

    <body>
        <form action="code_playgroundf.php" method="POST">
            <input type="submit" name="start" value="Start" class="btn btn-primary">
            <br><br>
            <input type="submit" name="end" value="End" class="btn btn-primary">
        </form>

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
            $sst = new DateTime($_SESSION['start']);
            $eet = new DateTime($_SESSION['end']);
            $stud_id = $_SESSION['id'];
            $class_id = $_SESSION['class_id'];
            $asgn_id = $_SESSION['asgn_id'];

            $diff = date_diff($eet, $sst);
            $sst1 = $sst->format("Y-m-d h:i:s");
            $eet1 = $eet->format("Y-m-d h:i:s");
            $diff1 = $diff->format("Y-m-d h:i:s");
            $timeelapsed = $diff->format("%h:%i:%s");
            $currentdate = strtotime($timeelapsed);

            $insert = mysqli_query($db, ("INSERT INTO time_spent (stud_id,class_id,asgn_id,sst,eet,diff)
                VALUES ('$stud_id','$class_id','$asgn_id','$sst1', '$eet1', '$timeelapsed')"));
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

        <div id="codepen" style="display: none;">

            <div class="sec-widget" data-widget="91e9db5da17762311a7ccdb996f6db55" style="display: none;"></div>
        </div>
        <?php
        // Include the database configuration file
        error_reporting(0);
        include 'dbConfig.php';
        $statusMsg = '';

        // File upload path
        $targetDir = "codeplaysub/";
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
                    $insert = $db->query("INSERT into codeplay (file_name, uploaded_on) VALUES ('" . $fileName . "', NOW())");
                    if ($insert) {
                        $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    } else {
                        $statusMsg = "";
                    }
                } else {
                    $statusMsg = "";
                }
            } else {
                $statusMsg = '';
            }
        } else {
            $statusMsg = '';
        }

        // Display status message
        echo $statusMsg;
        ?>
        <form action="code_playground.php<?php echo '?id=' . $url_id . '&ai=' . $row['id']; ?>" method="post" enctype="multipart/form-data" style="display:none">
            Select File to Upload:
            <input type="file" name="file" class="btn btn-primary">
            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
        
    </body>

    </html>