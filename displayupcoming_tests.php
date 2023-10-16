<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'virtual lab environment';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$week = 1;
$url_id=$_SESSION['class_id'];
//Date timestamps for comparision
$gmtDate = date("Y-m-d h:i:s");
$currentdate = strtotime($gmtDate."+5 hours 30 minutes");
$startdate = strtotime($gmtDate."+1 week 5 hours 30 minutes");
$current_time=date("Y-m-d h:i:s",$currentdate);
$time_in_a_week=date("Y-m-d h:i:s",$startdate);

$sql_query = mysqli_query($con, "SELECT * FROM `tests` WHERE `class_id`='$url_id' AND `subdatetime`<'$time_in_a_week' AND `subdatetime`>'$current_time'");
$count = mysqli_num_rows($sql_query);
if ($count > 0) {
    while ($row = mysqli_fetch_array($sql_query)) {
?>
        <button class="accordion" >TEST <?php echo $week ?></button>
        <div class="panel"  >
            <div class="flx">
                <div class="assignment">
                    <p>
                        <?php echo $row['question'].'  '.$row['subdatetime'] ?>
                    </p>
                </div>
                <div class="code_playground">
                    <a href="code_playground.php"><button>Code Playground</button></a>
                </div>
            </div>
        </div>
<?php $week=$week+1;}
}
else {
    
} ?>