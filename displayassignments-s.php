<?php
include("configclasssub.php");
$week = 1;
$url_id=$_SESSION['class_id'];
$sql_query = mysqli_query($con, "SELECT * FROM `assignments` WHERE `class_id`='$url_id'");
$count = mysqli_num_rows($sql_query);
if ($count > 0) {
    while ($row = mysqli_fetch_array($sql_query)) {
?>
        <button class="accordion" >WEEK <?php echo $week ?></button>
        <div class="panel" >
            <div class="flx">
                <div class="assignment">
                    <p>
                        <?php echo $row['question'].'  '.$row['subdatetime'] ?>
                    </p>
                </div>
                <div class="code_playground">
                    <a href="code_playground.php<?php echo '?id=' . $url_id.'&ai='.$row['id']; ?>"><button>Code Playground</button></a>
                </div>
            </div>
        </div>
<?php $week=$week+1;}
} ?>