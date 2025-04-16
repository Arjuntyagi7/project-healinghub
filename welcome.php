<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>

<h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
<p>You have successfully logged in.</p>
<a href="logout.php">Logout</a>

</body>
</html>
