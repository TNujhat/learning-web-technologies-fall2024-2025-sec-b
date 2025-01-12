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
<html>
<head>
    <title>Employee Registration</title>
    <style>
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
  background-color:rgb(60, 26, 86);
 
  color: white;
  padding: 40px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
}
header h1 {
  font-family: "Times New Roman", Times, serif;
  font-size: xx-large;
  margin: 0;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}
.navbar {
  background-color: rgb(190, 164, 209);
  height: 45px;
}
#logout {
  position: absolute;
  top: 80px;
  right: 50px;
}
 
#logout img {
  height: 40px;
 
  width: 40px;
}
#logout img:hover {
  height: 42px;
 
  width: 42px;
}
#apply {
    position: absolute;
    top: 135px;
    right: 525px;
  }

  #apply fieldset {
    width: 90%;
    background-color:rgb(247, 224, 182); 
    border: 2px solidrgb(117, 52, 171); 
    padding: 20px; 
    border-radius: 8px; 
  }

  #apply table {
    width: 100%;
    margin: auto; 
    text-align: left;
    border-collapse: collapse;
  }

  #apply th {
    text-align: left;
    padding: 8px;
  }

  #apply td {
    padding: 5px;
  }

  #apply h3 {
    text-align: center;
    color:rgb(122, 38, 217);
  }

  #apply button {
    background-color:rgb(122, 38, 217); 
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
  }

  #apply button:hover {
    background-color:rgb(168, 73, 232); 
  }

    .success-message {
            color: green;
            font-size: 20px;
            text-align: center;
            margin: 20px auto;
            background-color: #eaffea;
            padding: 15px 20px;
            border: 1px solid green;
            border-radius: 5px;
            width: 80%;
        }

        .error-message {
            color: red;
            font-size: 20px;
            text-align: center;
            margin: 20px auto;
            background-color: #ffeaea; 
            padding: 15px 20px;
            border: 1px solid red;
            border-radius: 5px;
            width: 80%;
        }
    </style>
</head>
<body>
<header>
        <h1>Online Shop Management System</h1>
    </header>
    <div class="navbar">
    <div id="logout">
        <a href="../View/logout.php"><img src="../uploads/logout.png"></a>
      </div>
    </div>
    <?php echo $message; ?>
</body>
</html>
