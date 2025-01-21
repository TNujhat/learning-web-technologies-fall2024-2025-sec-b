<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'brta management');
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if ($password && $password === $password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../View/admin_dashboard.php"); 
        exit();

        echo "<p style='color:red;'>Invalid username or password.</p>";
    }


    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex; 
    justify-content: center; 
    align-items: center; 
    height: 100vh; 
}

/* Login Container */
.login-container {
    background-color: #fff;
    border: 2px solidrgb(57, 142, 61);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px 30px;
    width: 320px;
    text-align: center;
}


.header-bar {
    background-color:rgb(57, 142, 61);
    padding: 10px;
    border-radius: 10px 10px 0 0;
}

.header-logo {
    width: 80px;
    height: auto;
}

h1 {
    font-size: 1.5rem;
    color: #333;
    margin: 20px 0;
}

form input[type="text"], 
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;

}

form input[type="submit"] {
    background-color:rgb(57, 142, 61);
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;

    cursor: pointer;
    width: 100%;
    margin-top: 10px;
}
form input[type="submit"] {
    background-color:rgb(57, 142, 61);
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;

    cursor: pointer;
    width: 100%;
    margin-top: 10px;
}

form input[type="submit"]:hover {
    background-color:rgb(57, 142, 61);
}

    </style>
</head>
<body>
<div class="login-container">
        <header class="header-bar">
            <img src="../uploads/BRTA_Logo.png" alt="BRTA Logo" class="header-logo">
        </header>
        <h2>Login as Admin</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
    <input type="text" name="username" placeholder="Enter your username" >
    <input type="password" name="password" placeholder="Enter your password" >
    <input type="submit" value="Login">
    </form>
</body>
</html>
