<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("location: ../View/admin_login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'brta management');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
    if (isset($_POST['action']) && isset($_POST['email'])) {
        $email = $_POST['email']; // Use email to identify
        $status = ($_POST['action'] === 'approve') ? 'Approved' : 'Refused';
    
        $update_sql = "UPDATE permit_appliers SET status='$status' WHERE email='$email'";  // Update based on email
        $conn->query($update_sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
$sql = "SELECT * FROM permit_appliers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Permit Appliers</title>
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
        .action-buttons form {
            display: inline-block;
        }
        .action-buttons button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }
        .approve-btn:hover {
            background-color: #45a049;
        }
        .refuse-btn {
            background-color: #f44336;
            color: white;
        }
        .refuse-btn:hover {
            background-color: #d32f2f;
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
    <h2>Road Permit Appliers</h2>
   <table border="1">

        <tr>
            <th>Name</th>
            <th>NID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Vehicle Type</th>
            <th>Reg number</th>
            <th>Starting point</th>
            <th>Ending point</th>
            <th>Registration Document</th>
            <th>Insurance certificate</th>
            <th>Status</th>
            <th>Action</th>  
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['nid'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['vehicletype'] ?></td>
        <td><?= $row['reg_num'] ?></td>
        <td><?= $row['start_point'] ?></td>
        <td><?= $row['end_point'] ?></td>
        <td><a href="../uploads/<?= $row['vehicleRegDoc'] ?>" target="_blank">View</a></td>
        <td><a href="../uploads/<?= $row['insuranceCert'] ?>" target="_blank">View</a></td>
            <td><?= isset($row['status']) ? $row['status'] : 'Pending' ?></td>
            <td class="action-buttons">
            <form method="POST" action="">
                <input type="hidden" name="email" value="<?= $row['email'] ?>"> <!-- Use email to identify -->
                <button type="submit" name="action" value="approve" class="approve-btn">Approve</button>
                <button type="submit" name="action" value="refuse" class="refuse-btn">Refuse</button>
            </form>
            </td>

        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
