<?php
include("configclass.php");


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

$url_id = substr(parse_url($url, PHP_URL_QUERY), 3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="classstyle.css">
</head>

<body>
    <?php include("navtop.php"); ?>
    <div class="flx">
        <?php include("sidenav.php"); ?>
        <div class="content" style=" min-width:70vw; margin-top: 50px; margin-right: 80px;">
            <div class="card" style="width:60vw;background-color:white;">
                <div class="card-header">
                    <h4>Add Assignment</h4>
                </div>
                <div class="card-body">

                    <form action="add_assignment.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="">Assignment Question</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Due Date</label>
                            <input type="datetime-local" name="event_dt" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="save_datetime" class="btn btn-primary">Save Assignment</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>