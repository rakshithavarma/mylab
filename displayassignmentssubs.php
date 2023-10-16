<?php
include("configclasssub.php");
$week = 1;
$url_id=$_SESSION['class_id'];
$sql_query = mysqli_query($con, "SELECT * FROM `assignments` WHERE `class_id`='$url_id'");
$count = mysqli_num_rows($sql_query);
if ($count > 0) {
    while ($row = mysqli_fetch_array($sql_query)) {
?>
        <button class="accordion" style="background-color: #00509d!important;">WEEK <?php echo $week ?></button>
        <div class="panel"  >
            <div class="flx">
                <div class="assignment">
                    <p>
                        <?php echo $row['question'].'  '.$row['subdatetime'] ?>
                    </p>
                </div>
                <div class="code_playground">
                    <a href="submissions-<?php if ($_SESSION["role"] === 2) {
                                echo "s";
                            } elseif ($_SESSION["role"] === 1) {
                                echo "t";
                            }?>.php<?php echo '?id=' . $url_id.'&ai='.$row['id']; ?>"><button  class="btn btn-primary">Submissions</button></a>
                </div>
            </div>
        </div>
<?php $week=$week+1;}
} ?>