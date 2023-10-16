<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["role"] == 2) {
        header("location: welcome-s.php");
    } elseif ($_SESSION["role"] == 1) {
        header("location: welcome-t.php");
    } elseif ($_SESSION["role"] == 3) {
        header("location: welcome-a.php");
    }
    exit;
}
// Include config file
include("config.php");


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, role, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $role, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if ($role === 3) {
                            if ($password === $hashed_password) {
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["role"] = $role;
                                header("location: welcome-a.php");
                                // Redirect user to welcome page
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        } else {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["role"] = $role;

                                // Redirect user to welcome page

                                if ($role == 2) {
                                    header("location: welcome-s.php");
                                } elseif ($role == 1) {
                                    header("location: welcome-t.php");
                                }
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="style1.css" rel="stylesheet" type="text/css">
    <link rel="manifest" href="/manifest.json" />
    <style>
        body {
            font: 14px sans-serif;
            background-image: url("images/log1.jpg");
        }

        .wrapper {
            background-color: aliceblue;
            width: 360px;
            padding: 20px;
            margin-top: 15vh;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

</head>

<body>
    <nav class="navtop">
        <div>
            <a class="navbar-brand" href="#">
                <img src="images/mylab.png" alt="Logo" style="width:40px; padding-top: 5px;" class="rounded-pill">
            </a>
            <h1>MyLab</h1>
        </div>
    </nav>
    <div class="wrapper" style="border-radius: 12px;">
        <h2 style="text-align: center">Login</h2>
        <p style="text-align: center">Please fill in your credentials to login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <br> <a href="register-t.php">Sign up as a teacher</a>. <br><a href="register-s.php">Sign up as a student</a>.</p>
        </form>
    </div>
    <?php include("chatbot_index.php"); ?>
</body>

</html>