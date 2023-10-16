<?php

// Establish Link to the database and start session
include("configclass.php");

// Check if the user is logged in, if not then redirect him to login page
include("setsession.php");

// Extract ID of the Classroom
include("extractClassID.php");
$url_id = $_SESSION["class_id"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="classstyle.css">
  <title>Classroom</title>
</head>

<body>
  <?php include("navtop.php"); ?>

  <div class="flx">
    <?php include("sidenav.php"); ?>
    <div class="content">
      <?php
      include("displayassignments.php");
      include("displaytests.php");
      ?>
    </div>
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
<!-- 

Warning
: Trying to access array offset on value of type null in
C:\xampp\htdocs\Hello\class_template-t.php
on line
174


Warning
: Trying to access array offset on value of type null in
C:\xampp\htdocs\Hello\class_template-t.php
on line
175

Lab -

 -->