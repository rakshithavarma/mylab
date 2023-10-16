
                                    <?php
                                    session_start();
                                    $DATABASE_HOST = 'localhost';
                                    $DATABASE_USER = 'root';
                                    $DATABASE_PASS = '';
                                    $DATABASE_NAME = 'virtual lab environment';
                                    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                    if (mysqli_connect_errno()) {
                                        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                                    }
                                    
                                        $subject = $_POST['csubject'];
                                        $section = $_POST['csection'];
                                        $tid = $_SESSION["id"];
                                        $sql = mysqli_query($con, "SELECT * FROM subjects WHERE id = $subject");
                                        $row = mysqli_fetch_array($sql);
                                        $subject_title = $row['title'];
                                        $thumbnail = $row['thumbnail'];
                                        $code = $row['code'];
                                        $sql = mysqli_query($con, "SELECT class_title from sections WHERE id = '$section'");
                                        $row = mysqli_fetch_array($sql);
                                        $class_title = $row['class_title'];
                                        $query = mysqli_query($con, "INSERT INTO classes (teacher_id, subject_id, section_id, subject_title, code, section, thumbnail) VALUES ('$tid', '$subject', '$section', '$subject_title', '$code', '$class_title', '$thumbnail')");


                                        // Check if the user is already logged in, if yes then redirect him to welcome page
                                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                            if ($_SESSION["role"] == 2) {
                                                header("location: welcome-s.php");
                                            } elseif ($_SESSION["role"] == 1) {
                                                header("location: welcome-t.php");
                                            } elseif ($_SESSION["role"] == 3) {
                                                header("location: welcome.php");
                                            }
                                            exit;
                                        }
                                    ?>