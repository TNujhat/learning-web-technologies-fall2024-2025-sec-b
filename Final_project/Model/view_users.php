<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("location: ../View/admin_login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'brta management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM license_appliers";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>View License Appliers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color:rgb(250, 234, 215);
        }
        header {
            background-color: #066f22;
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
        #brtalogo {
            position: absolute;
            top: 9px;
            left: 90px;
        }
        #brtalogo img {
            width: 60px;
            height: auto;
        }
        .navbar {
            background-color: coral;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: relative;
        }
        .navbar img {
            height: 35px;
            width: 35px;
            margin: 0 15px;
            cursor: pointer;
        }
        .navbar img:hover {
            height: 40px;
            width: 40px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
<div id="brtalogo"><img src="../uploads/BRTA_Logo.png" alt="BRTA Logo"></div>
    <h1>BRTA Management Portal</h1>
</header>
<div class="navbar">
<a href="../View/admin_dashboard.php"><img src="../uploads/home.png" alt="Home"></a>
    <a href="../View/admin_profile.php"><img src="../uploads/profile.png" alt="Profile"></a>
    <a href="../View/admin_logout.php"><img src="../uploads/logout.png" alt="Logout"></a>
</div>
    <h2>License Appliers List</h2>
    <br><br>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Father's Name</th>
            <th>Date of Birth</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Blood Group</th>
            <th>Address</th>
            <th>Gender</th>
            <th>License Type</th>
            <th>NID</th>
            <th>Picture</th>
            <th>NID Front</th>
            <th>NID Back</th>
            <th>Medical Report</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['fname']}</td>
                    <td>{$row['dob']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['bloodgroup']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['licensetype']}</td>
                    <td>{$row['nid']}</td>
                    <td><a href='{$row['picture']}' target='_blank'>View</a></td>
                    <td><a href='{$row['nidFront']}' target='_blank'>View</a></td>
                    <td><a href='{$row['nidBack']}' target='_blank'>View</a></td>
                    <td><a href='{$row['medicalReport']}' target='_blank'>View</a></td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No data found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
