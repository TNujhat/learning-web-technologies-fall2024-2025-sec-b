<?php
session_start();
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $nid = $_POST['nid'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $vehicletype = $_POST['vehicletype'];
    $reg_num = $_POST['reg_num'];
    $start_point = $_POST['start_point'];
    $end_point = $_POST['end_point'];

 
    $vehicleRegDoc = $_FILES['vehicleRegDoc'];
    $insuranceCert = $_FILES['insuranceCert'];

    $uploadDir = "../uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $vehicleRegDocPath = $uploadDir . basename($vehicleRegDoc["name"]);
    $insuranceCertPath = $uploadDir . basename($insuranceCert["name"]);

    move_uploaded_file($vehicleRegDoc["tmp_name"], $vehicleRegDocPath);
    move_uploaded_file($insuranceCert["tmp_name"], $insuranceCertPath);

    if (empty($name) || empty($nid) || empty($email) || empty($phone) || empty($address) || 
    empty($vehicletype) || empty($reg_num) || empty($start_point) || empty($end_point)) {
    $message = "<div class='error-message'>Error: All fields are required.</div>";
} elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
    $message = "<div class='error-message'>Error: Invalid phone number format.</div>";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "<div class='error-message'>Error: Invalid email format.</div>";
} else {
  
        $conn = new mysqli('localhost', 'root', '', 'brta management');
}
        if ($conn->connect_error) {
            die("Error: Unable to connect to the database. " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO permit_appliers (name, nid, email, phone, address, vehicletype, reg_num, start_point, end_point, vehicleRegDoc, insuranceCert) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "sssssssssss",
                $name,
                $nid,
                $email,
                $phone,
                $address,
                $vehicletype,
                $reg_num,
                $start_point,
                $end_point,
                $vehicleRegDocPath,
                $insuranceCertPath
            );

            if ($stmt->execute()) {
                $message = "<div class='success-message'>Your application for a road permit is successfully submitted.</div>";
            } else {
                $message = "<div class='error-message'>Error: Unable to save your data. Please try again.</div>";
            }
            
            $stmt->close();
            $conn->close();
        }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Road Permit Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        header {
            background-color: #066f22;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

header h1 {
            font-family: "Times New Roman", Times, serif;
            font        -size: 24px;
            margin: 0;
        }

        #brtalogo {
            position: absolute;
            top: 10px;
            left: 20px;
        }

        #brtalogo img {
            width: 50px;
            height: auto;
        }

        .navbar {
            background-color: coral;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: relative;
            padding-right: 20px;
        }

        .navbar img {
            height: 35px;
            width: 35px;
            transition: all 0.3s ease;
        }

        .navbar img:hover {
            height: 40px;
            width: 40px;
        }

        .success-message, .error-message {
            font-size: 18px;
            text-align: center;
            margin: 20px auto;
            padding: 15px;
            border-radius: 5px;
            width: 80%;
        }

        .success-message {
            color: green;
            background-color: #eaffea;
            border: 1px solid green;
        }

        .error-message {
            color: red;
            background-color: #ffeaea;
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Road Permit Application</h1>
        <div id="brtalogo"><img src="../uploads/BRTA_Logo.png" alt="BRTA Logo"></div>
    </header>
    <div class="navbar">
        <a href="../View/user_dashboard.php"><img src="../uploads/home.png" alt="Home"></a>
        <div id="profile">
        <img src="../uploads/profile.png" />
      </div>
        <a href="../View/logout.php"><img src="../uploads/logout.png" alt="Logout"></a>
    </div>
    <?php echo $message; ?>
</body>
</html>
