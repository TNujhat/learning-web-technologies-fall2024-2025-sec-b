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
        echo "<div class='error-message'>No record found for the given email.</div>";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $sql = "DELETE FROM license_appliers WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);

        if ($stmt->execute()) {
            echo "<div class='success-message'>The record has been successfully deleted.</div>";
        } else {
            echo "<div class='error-message'>Error: Unable to delete the record. Please try again.</div>";
        }
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
    echo "<div class='error-message'>Email parameter is missing!</div>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete License Application</title>
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
    <div id="home"><a href="../View/user_dashboard.php"><img src="../uploads/home.png" /></a></div>
    <div id="logout"><a href="../View/logout.php"><img src="../uploads/logout.png" /></a></div>
</div>
<div id="apply">
    <fieldset>
        <h3>Delete Record</h3>
        <p>Are you sure you want to delete the record for <b><?php echo $row['name']; ?></b>?</p>
        <form method="post" action="">
            <input type="submit" name="submit" value="Delete Information" />
        </form>
    </fieldset>
</div>
</body>
</html>