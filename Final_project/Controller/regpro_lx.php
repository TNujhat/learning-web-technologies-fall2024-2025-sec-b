<?php
session_start();

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($name) || empty($phone) || empty($username) || empty($password)) {
        $message = "<div class='error-message'>Error: All fields are required.</div>";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $message = "<div class='error-message'>Error: Invalid phone number format. Please enter a 10-digit number.</div>";
    } else {
        $conn = new mysqli('localhost', 'root', '', 'employees');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO employee (name, phone, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $phone, $username, $password);

            if ($stmt->execute()) {
                $message = "<div class='success-message'>Registration successful! Employee data has been saved.</div>";
            } else {
                $message = "<div class='error-message'>Error: Unable to save the data. Please try again.</div>";
            }

            $stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: white;
        }
        header {
            background-color: rgb(60, 26, 86);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .success-message, .error-message {
            color: white;
            text-align: center;
            margin: 20px auto;
            padding: 15px 20px;
            border-radius: 5px;
            width: 80%;
        }
        .success-message {
            background-color: green;
        }
        .error-message {
            background-color: red;
        }
        form {
            margin: 20px auto;
            width: 80%;
            text-align: center;
        }
        form input {
            padding: 10px;
            margin: 10px;
            width: 80%;
        }
        form button {
            padding: 10px 20px;
            background-color: rgb(122, 38, 217);
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: rgb(168, 73, 232);
        }
    </style>
    <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            let errorMessage = '';

            if (!name) errorMessage = 'Name is required.';
            else if (!phone) errorMessage = 'Phone number is required.';
            else if (!/^[0-9]{10}$/.test(phone)) errorMessage = 'Phone number must be a 10-digit number.';
            else if (!username) errorMessage = 'Username is required.';
            else if (!password) errorMessage = 'Password is required.';

            if (errorMessage) {
                document.getElementById('error-message').innerText = errorMessage;
                return false; 
            }

            return true; 
        }
    </script>
</head>
<body>
<header>
    <h1>Online Shop Management System</h1>
</header>

<?php echo $message; ?>

<form method="POST" onsubmit="return validateForm();">
    <div id="error-message" class="error-message" style="display: none;"></div>
    <input type="text" id="name" name="name" placeholder="Name">
    <input type="text" id="phone" name="phone" placeholder="Phone">
    <input type="text" id="username" name="username" placeholder="Username">
    <input type="password" id="password" name="password" placeholder="Password">
    <button type="submit">Register</button>
</form>
</body>
</html>
