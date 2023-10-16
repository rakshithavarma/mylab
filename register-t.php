<?php
// Include config file
include("config.php");

// Define variables and initialize with empty values
$firstname = $lastname = $emailid = $username = $password = $confirm_password = "";
$firstname_err = $lastname_err = $emailid_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["firstname"]))) {
        $username_err = "Please enter a first name.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }
    if (empty(trim($_POST["lastname"]))) {
        $username_err = "Please enter a last name.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }
    if (empty(trim($_POST["emailid"]))) {
        $username_err = "Please enter a email id.";
    } elseif (!preg_match('/^(\D[a-z0-9\+_\-]+)@gvpce\.ac\.in$/', trim($_POST["emailid"]))) {
        $emailid_err = "Invalid Email ID";
    } else {
        $emailid = trim($_POST["emailid"]);
    }
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM students WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($firstname_err) && empty($lastname_err) && empty($emailid_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO teachers (firstname, lastname, emailid, username, password) VALUES (?, ? , ? , ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_firstname, $param_lastname, $param_emailid, $param_username, $param_password);

            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_emailid = $emailid;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header('Location: index.php');
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font: 14px sans-serif;
            background-image: url("images/log2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
            background-color: aliceblue;
            width: 360px;
            padding: 20px;
            margin-top: 5vh;
            margin-bottom: 2.5vh;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <nav class="navtop" style="background-color: rgb(234, 249, 255) !important;">
        <div>
            <a class="navbar-brand" href="#">
                <img src="images/mylab.png" alt="Logo" style="width:40px; padding-top: 5px;" class="rounded-pill">
            </a>
            <h1 style="color: #00509d!important;">MyLab</h1>
        </div>
    </nav>
    <div class="wrapper" style="border-radius: 12px;">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                <span class="invalid-feedback">
                    <?php echo $firstname_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                <span class="invalid-feedback">
                    <?php echo $lastname_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Email ID</label>
                <input type="text" name="emailid" class="form-control <?php echo (!empty($$emailid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailid; ?>">
                <span class="invalid-feedback">
                    <?php echo $emailid_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback">
                    <?php echo $username_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>

    <?php include("chatbot_index.php"); ?>
</body>

</html>