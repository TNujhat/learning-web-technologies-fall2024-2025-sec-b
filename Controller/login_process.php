<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the submitted username and password
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        echo "<p style='color:red;'>Both fields are required.</p>";
        exit();
    }

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'brta management');

    // Check database connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to fetch the username and password
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();

    // Verify the provided password
    if ($password && $password === $password) {
        // Successful login
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../View/user_dashboard.php"); // Redirect to user dashboard
        exit();
    } else {
        // Invalid credentials
        echo "<p style='color:red;'>Invalid username or password.</p>";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

}
?>
