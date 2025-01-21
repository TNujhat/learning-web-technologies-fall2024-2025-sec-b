<?php
session_start();

if (isset($_GET['email'])) {
    $email = $_GET['email'];


    $conn = new mysqli('localhost', 'root', '', 'brta management');
    if ($conn->connect_error) {
        die("Error: Unable to connect to the database. " . $conn->connect_error);
    }

    $sql = "SELECT * FROM license_appliers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for the given email.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $dob = $_POST['dob'];
        $phone = $_POST['phone'];
        $bloodgroup = $_POST['bloodgroup'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $licensetype = $_POST['licensetype'];
        $nid = $_POST['nid'];

        $picturePath = $row['picture'];
        $nidFrontPath = $row['nidFront'];
        $nidBackPath = $row['nidBack'];
        $medicalReportPath = $row['medicalReport'];
    }

        if (!empty($_FILES['picture']['name'])) {
            $picturePath = "../uploads/" . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $picturePath);
        }
        if (!empty($_FILES['nidFront']['name'])) {
            $nidFrontPath = "../uploads/" . basename($_FILES['nidFront']['name']);
            move_uploaded_file($_FILES['nidFront']['tmp_name'], $nidFrontPath);
        }
        if (!empty($_FILES['nidBack']['name'])) {
            $nidBackPath = "../uploads/" . basename($_FILES['nidBack']['name']);
            move_uploaded_file($_FILES['nidBack']['tmp_name'], $nidBackPath);
        }
        if (!empty($_FILES['medicalReport']['name'])) {
            $medicalReportPath = "../uploads/" . basename($_FILES['medicalReport']['name']);
            move_uploaded_file($_FILES['medicalReport']['tmp_name'], $medicalReportPath);
        }

        $sql = "UPDATE license_appliers SET 
                name = ?, fname = ?, dob = ?, phone = ?, bloodgroup = ?, address = ?, 
                gender = ?, licensetype = ?, nid = ?, picture = ?, nidFront = ?, 
                nidBack = ?, medicalReport = ? WHERE email = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssssssss', $name, $fname, $dob, $phone, $bloodgroup, $address, 
            $gender, $licensetype, $nid, $picturePath, $nidFrontPath, 
            $nidBackPath, $medicalReportPath, $email);

        if ($stmt->execute()) {
            echo "<div class='success-message'>Your information has been successfully updated.</div>";
        } else {
            echo "<div class='error-message'>Error: Unable to update your data. Please try again.</div>";
        }

        $stmt->close();
    }
 else {
    echo "Email parameter is missing!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit License Application</title>
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
        .success-message, .error-message {
            text-align: center;
            margin: 20px auto;
            padding: 10px;
            border-radius: 5px;
            width: 80%;
        }
        .success-message {
            background-color: #eaffea;
            color: green;
            border: 1px solid green;
        }
        .error-message {
            background-color: #ffeaea;
            color: red;
            border: 1px solid red;
        }
                #apply {
            position: absolute;
            top: 200px;
            right: 525px;
        }

        #apply fieldset {
            height: 10%;
            width: 90%;
            background-color:rgb(247, 224, 182); 
            border: 1px solidrgb(117, 52, 171); 
            padding: 10px; 
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
            padding: 3px;
        }

        #apply h3 {
            text-align: center;
            color:rgb(122, 38, 217);/* Header color */
        }

        #apply button {
            background-color:rgb(122, 38, 217); /* Button color */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        #apply button:hover {
            background-color:rgb(168, 73, 232); /* Darker button color on hover */
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
    <div id="apply">
        <fieldset>
        <h3>Edit Your Information</h3>
        <form method="post" action="" enctype="multipart/form-data">
    <table>
        <tr>
        <td>Name:</td>
        <td><input type="text" name="name" value="<?php echo $row['name']; ?>" required /></td>
    </tr>
    <tr>
        <td>Father's Name:</td>
        <td><input type="text" name="fname" value="<?php echo $row['fname']; ?>" required /></td>
    </tr>
    <tr>
        <td>Date of Birth:</td>
        <td><input type="date" name="dob" value="<?php echo $row['dob']; ?>" required /></td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td><input type="text" name="phone" value="<?php echo $row['phone']; ?>" required /></td>
    </tr>
    <tr>
        <td>Blood Group:</td>
        <td><input type="text" name="bloodgroup" value="<?php echo $row['bloodgroup']; ?>" required /></td>
    </tr>
    <tr>
        <td>Address:</td>
        <td><input type="text" name="address" value="<?php echo $row['address']; ?>" required /></td>
    </tr>
    <tr>
        <td>Gender:</td>
        <td><input type="text" name="gender" value="<?php echo $row['gender']; ?>" required /></td>
    </tr>
    <tr>
        <td>License Type:</td>
        <td><input type="text" name="licensetype" value="<?php echo $row['licensetype']; ?>" required /></td>
    </tr>
    <tr>
        <td>NID:</td>
        <td><input type="text" name="nid" value="<?php echo $row['nid']; ?>" required /></td>
    </tr>
    <tr>
        <td>Profile Picture:</td>
        <td><input type="file" name="picture" /></td>
    </tr>
    <tr>
        <td>NID Front:</td>
        <td><input type="file" name="nidFront" /></td>
    </tr>
    <tr>
        <td>>NID Back:</td>
        <td><input type="file" name="nidBack" /></td>
    </tr>
    <tr>
        <td>Medical Report:</td>
        <td><input type="file" name="medicalReport" /></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <input type="submit" name="submit" value="Update Information" />
        </td>
    </tr>
    </table>
        </form>
    </fieldset>
    </div>
</body>
</html>
