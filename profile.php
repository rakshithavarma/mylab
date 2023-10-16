<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'virtual lab environment';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT role, password, username, firstname, lastname, emailid FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($role, $password, $username, $firstname, $lastname, $emailid);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
	<?php include("navtop.php"); ?>
	<div class="content">
		<h2>Profile Page</h2>
		<div>
			<p>Your account details are below:</p>
			<table>
				<tr>
					<td>Username:</td>
					<td><?php echo $username; ?></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><?php echo $firstname; ?></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><?php echo $lastname; ?></td>
				</tr>
				<tr>
					<td>Email ID:</td>
					<td><?php echo $emailid; ?></td>
				</tr>
				<tr>
					<td>Role:</td>
					<td><?php if ($role == 2) {
							echo "Student";
						} elseif ($role == 1) {
							echo "Teacher/Course Administrator";
						} elseif ($role == 3) {
							echo "Administrator";
						} ?></td>
				</tr>
			</table>
		</div>
	</div>
	
</body>

</html>