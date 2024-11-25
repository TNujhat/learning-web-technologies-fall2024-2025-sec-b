<?php
session_start();

if (!isset($_SESSION['xyz'])) {
    header('Location: login.html');
    exit();  
}
?>

<html>
<head>
    <title>HOME Page</title>
</head>
<body>
    <h1>Welcome Home!</h1>
    <p>You are logged in.</p>
    <a href="logout.php">Logout</a> 
</body>
</html>
