<?php
// Include the database configuration file
session_start();
error_reporting(0);
include 'dbConfig.php';
$statusMsg = '';

include("extractClassID.php");

// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"])) {
    // Allow certain file formats

    $name_of_the_ref = $_POST['name_of_the_ref'];
    $file_link = $_POST["file_link"];
    if (!empty($_FILES["file"]["name"])) {
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'ppt', 'doc', 'pptx', 'docx', 'xlxs');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $insert = $db->query("INSERT INTO reference_materials (class_id,file_name,name_of_the_reference,file_link,uploaded_on)
                VALUES ('$url_id', '" . $fileName . "','$name_of_the_ref','$file_link', NOW())");
                if ($insert) {
                    $statusMsg = "";
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
        $insert = $db->query("INSERT INTO reference_materials (class_id,name_of_the_reference,file_link,uploaded_on)
                VALUES ('$url_id','$name_of_the_ref','$file_link', NOW())");
        if ($insert) {
            $statusMsg = "";
        } else {
            $statusMsg = "";
        }
    }
} else {
    $statusMsg = '';
}

// Display status message
echo $statusMsg;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="classstyle.css">
    <title>Upload</title>



</head>

<body>
    <?php include("navtop.php"); ?>
    <div class="flx">
        <?php include("sidenav.php"); ?>
        <div class="content" style="margin-top: 50px!important;">

                        <div class="card" style="width:60vw;background-color:white;">
                            <div class="card-header">
                                <h4>Required Material</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-xl">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Link</th>
                                            <th>Document</th>
                                            <th></th>
                                            <th>Uploaded On</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $con = mysqli_connect("localhost", "root", "", "virtual lab environment");

                                    $query = "SELECT * FROM reference_materials WHERE `class_id`='$url_id'";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                    ?>
                                            <tr>


                                                <td><?= $row['name_of_the_reference']; ?></td>
                                                <td>
                                                    <a href="<?= $row['file_link']; ?>" target="_blank"><?php echo substr($row['file_link'], 0, 40); ?></a>
                                                </td>
                                                <td><?php echo substr($row['file_name'], 0, 20); ?>

                                                </td>
                                                <td><?php if (!(($row['file_name']) === "")) {
                                                        echo ('<a href="uploads/' . $row['file_name'] . '" target="_blank">View File</a>');
                                                    } ?></td>
                                                <td><?= $row['uploaded_on']; ?></td>
                                            </tr>

                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <td colspan="">No Record Found</td>

                                    <?php
                                    }
                                    ?>

                            </div>
                </div>
            <div class="container m-4">
                <form action="uploadreferences.php<?php echo '?id=' . $url_id; ?>" method="post" enctype="multipart/form-data">
                    <input class="mx-2" type="text" name="name_of_the_ref" id="" placeholder="E.g.: Binary Search Trees, Scheduling Algorithms">
                    <input class="mx-2" type="url" name="file_link">
                    Select File to Upload:
                    <input class="mx-2" type="file" name="file">
                    <input class="mx-2" type="submit" name="submit" value="Upload">

                </form>
            </div>


        </div>


    </div>
</body>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>

</html>