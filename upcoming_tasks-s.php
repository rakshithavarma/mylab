<?php
session_start();

include("configclasssub.php");


// Check if the user is logged in, if not then redirect him to login page
include("extractClassID.php");
include("setsession.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upcoming Tasks</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="classstyle.css">
</head>

<body>
  <?php include("navtop.php"); ?>
  <div class="flx">
    <?php include("sidenav.php"); ?>
    <div class="content">
      <?php
      include("displayupcoming_tasks.php");
      include("displayupcoming_tests.php");
      ?>
    </div>
  </div>
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



</body>

</html>