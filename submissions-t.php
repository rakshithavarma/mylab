<?php
include("configclass.php");
include("extractAsgnID.php");
$query = mysqli_query($con, "SELECT `subdatetime` FROM `assignments` WHERE `id`='$asgn_id'");
$row = mysqli_fetch_array($query);
$_SESSION['subtime'] = $row['subdatetime'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="classstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include("navtop.php"); ?>
    <div class="flx">
        <?php include("sidenav.php"); ?>
        <div class="content" style="margin-top: 50px; margin-left: auto;margin-right:auto;">
            <table class="table table-hover table-responsive-xl">
                <thead class="thead-dark">
                    <tr>
                        <th>Roll No.</th>
                        <th>Submission</th>
                        <th></th>
                        <th>Status</th>
                        <th>Submitted On</th>
                        <th>Time Spent on Environment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("configclasssub.php");
                    $sql_query = mysqli_query($con, "SELECT * FROM `assignment_submissions` WHERE `asgn_id`='$asgn_id'");
                    $count = mysqli_num_rows($sql_query);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_array($sql_query)) {
                    ?>
                            <tr>
                                <td><?= $row['username']; ?></td>
                                <td><?php echo substr($row['file_name'], 0, 20); ?></td>
                                <td><?php if (!(($row['file_name']) === "")) {
                                        echo ('<a href="assignments_submissions/' . $row['file_name'] . '" target="_blank">View File</a>');
                                    } ?></td>
                                <td><?php if ($row['uploaded_on'] < $_SESSION['subtime']) {
                                        echo "Submitted On Time";
                                    } else {
                                    ?><span style="color: red;"><?php echo "Late Submission";
                                                                            } ?></span></td>
                                <td><?= $row['uploaded_on']; ?></td>
                                <td align="center"><?= $row['diff']; ?></td>
                            </tr>

                        <?php
                        }
                    } else {
                        ?>

                        <td colspan="4">No Record Found</td>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>