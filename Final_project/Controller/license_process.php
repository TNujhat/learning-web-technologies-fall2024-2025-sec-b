<?php
session_start();
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_SESSION['name'];
    $fname = $_SESSION['fname'];
    $dob = $_SESSION['dob'];
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $bloodgroup = $_SESSION['bloodgroup'];
    $address = $_SESSION['address'];
    $gender = $_SESSION['gender'];
    $licensetype = $_SESSION['licensetype'];
    $nid = $_SESSION['nid'];

    $picture = $_FILES['picture'];
    $nidFront = $_FILES['nid-front'];
    $nidBack = $_FILES['nid-back'];
    $medicalReport = $_FILES['medical-report'];

    $uploadDir = "../uploads/";

  
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $picturePath = $uploadDir . basename($picture["name"]);
    $nidFrontPath = $uploadDir . basename($nidFront["name"]);
    $nidBackPath = $uploadDir . basename($nidBack["name"]);
    $medicalReportPath = $uploadDir . basename($medicalReport["name"]);

    move_uploaded_file($picture["tmp_name"], $picturePath);
    move_uploaded_file($nidFront["tmp_name"], $nidFrontPath);
    move_uploaded_file($nidBack["tmp_name"], $nidBackPath);
    move_uploaded_file($medicalReport["tmp_name"], $medicalReportPath);

    // Basic validations
    if (empty($name) || empty($fname) || empty($dob) || empty($phone) || empty($email) || empty($bloodgroup) ||
        empty($address) || empty($gender) || empty($licensetype) || empty($nid)) {
        $message = "<div class='error-message'>Error: All fields are required.</div>";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $message = "<div class='error-message'>Error: Invalid phone number format.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<div class='error-message'>Error: Invalid email format.</div>";
    } else {
        $conn = new mysqli('localhost', 'root', '', 'brta management');
        if ($conn->connect_error) {
            die("Error: Unable to connect to the database. " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO license_appliers (name, fname, dob, phone, email, bloodgroup, address, gender, licensetype, nid, picture, nidFront, nidBack, medicalReport) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssssssssssssss",
                $name,
                $fname,
                $dob,
                $phone,
                $email,
                $bloodgroup,
                $address,
                $gender,
                $licensetype,
                $nid,
                $picturePath,
                $nidFrontPath,
                $nidBackPath,
                $medicalReportPath
            );

            if ($stmt->execute()) {
                $message = "<div class='success-message'>Your application for a license is successfully submitted.</div>";
            } else {
                $message = "<div class='error-message'>Error: Unable to save your data. Please try again.</div>";
            }
            
            $stmt->close();
            $conn->close();
        }
    }
}
$conn = new mysqli('localhost', 'root', '', 'brta management');
if ($conn->connect_error) {
    die("Error: Unable to connect to the database. " . $conn->connect_error);
}

$email = $_SESSION['email']; 
$sql = "SELECT * FROM license_appliers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>license</title>
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
            font-size: 24px;
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

        .navbar div {
            margin-left: 20px;
        }

        #profile,
        #home,
        #logout {
            position: relative;
        }

        #profile img,
        #home img,
        #logout img {
            height: 35px;
            width: 35px;
            transition: all 0.3s ease;
        }

        #profile img:hover,
        #home img:hover,
        #logout img:hover {
            height: 40px;
            width: 40px;
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
        <h1>BRTA Service Portal</h1>
        <div id="brtalogo"><img src="../uploads/BRTA_Logo.png" /></div>
    </header>
    <div class="navbar">
        <div id="profile"><img src="../uploads/profile.png" /></div>
        <div id="home"> <a href="../View/user_dashboard.php"><img src="../uploads/home.png" /></div>
        <div id="logout"><a href="../View/logout.php"><img src="../uploads/logout.png" /></a></div>
    </div>
    <?php echo $message; ?>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='applier-info'>
                    <h3>Applicant Information</h3>
                    <p><b>Name</b>:{$row['name']}</p>
                    <p><b>Father's Name:</b> {$row['fname']}</p>
                    <p><b>Date of Birth:</b> {$row['dob']}</p>
                    <p><b>Phone:</b> {$row['phone']}</p>
                    <p><b>Email:</b> {$row['email']}</p>
                    <p><b>Blood Group:</b> {$row['bloodgroup']}</p>
                    <p><b>Address:</b> {$row['address']}</p>
                    <p><b>Gender:</b> {$row['gender']}</p>
                    <p><b>License Type:</b> {$row['licensetype']}</p>
                    <p><b>NID:</b> {$row['nid']}</p>
                    <p>
                        <a href='../View/edit.php?email={$row['email']}'>Edit</a> | 
                        <a href='../View/delete.php?email={$row['email']}'>Delete</a>
                    </p>
                  </div>";
        }
    } else {
        echo "<div class='applier-info'><p>No records found.</p></div>";
    }
    ?>
</body>
</html>
