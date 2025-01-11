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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'], $_POST['email'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $status = ($_POST['action'] === 'approve') ? 'Approved' : 'Refused';

    $update_sql = "UPDATE appointment_bookings SET status='$status' WHERE email='$email'";
    if ($conn->query($update_sql)) {
        $_SESSION['message'] = "Status successfully updated to '$status' for $email.";
    } else {
        $_SESSION['message'] = "Error updating status: " . $conn->error;
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch permit appliers
$sql = "SELECT * FROM appointment_bookings";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>appointment</title>
    <style>
        /* Styles omitted for brevity. Use the styles from your existing code. */
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

    <h2>Appointment Requests</h2>

    <!-- Display success or error message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <table border="1">
        <th>
            <tr>
                <th>Name</th>
                <th>NID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Vehicle Type</th>
                <th>Reg Number</th>
                <th>Starting Point</th>
                <th>Ending Point</th>
                <th>Registration Document</th>
                <th>Insurance Certificate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </th>
        <body>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?=$row['name'] ?></td>
                    <td><?=$row['nid'] ?></td>
                    <td><?=$row['email'] ?></td>
                    <td><?=$row['phone'] ?></td>
                    <td><?= $row['address']?></td>
                    <td><?= $row['vehicletype']?></td>
                    <td><?= $row['reg_num']?></td>
                    <td><?= $row['start_point']?></td>
                    <td><?= $row['end_point'] ?></td>
                    <td><a href="../uploads/<?= $row['vehicleRegDoc']?>" target="_blank">View</a></td>
                    <td><a href="../uploads/<?= $row['insuranceCert']) ?>" target="_blank">View</a></td>
                    <td><?= isset($row['status']) ? $row['status']) : 'Pending' ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="email" value="<?= $row['email']) ?>">
                            <button type="submit" name="action" value="approve" class="approve-btn">Approve</button>
                            <button type="submit" name="action" value="refuse" class="refuse-btn">Refuse</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </body>
    </table>
</body>
</html>
<?php
$conn->close();
?>
