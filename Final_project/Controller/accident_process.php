<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accident_date_time = $_POST['accident_date_time'];
    $location = $_POST['location'];
    $vehicle_number = $_POST['vehicle_number'];
    $description = $_POST['description'];
    $contact = $_POST['contact'];

   
    $photos = $_FILES['photos']['name'];
    $photos_tmp = $_FILES['photos']['tmp_name'];
    $upload_dir = "../uploads/accident_photos/"; 

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $uploaded_photos = [];
    foreach ($photos as $index => $photo) {
        $photo_path = $upload_dir . basename($photo);
        move_uploaded_file($photos_tmp[$index], $photo_path);
        $uploaded_photos[] = $photo_path;
    }

    if (empty($accident_date_time) || empty($location) || empty($vehicle_number) || empty($description) || empty($contact)) {
        $message = "<div class='error-message'>Error: All fields are required.</div>";
    } elseif (!preg_match('/^[0-9]{10}$/', $contact)) {
        $message = "<div class='error-message'>Error: Invalid phone number format.</div>";
 
        $conn = new mysqli('localhost', 'root', '', 'brta management');
        if ($conn->connect_error) {
            die("Error: Unable to connect to the database. " . $conn->connect_error);
        } else {
       
            $stmt = $conn->prepare(
                "INSERT INTO accidents (accident_date_time, location, vehicle_number, description, contact, photos) 
                VALUES (?, ?, ?, ?, ?, ?)"
            );

            $photos_string = implode(",", $uploaded_photos);

            $stmt->bind_param(
                "ssssss",
                $accident_date_time,
                $location,
                $vehicle_number,
                $description,
                $contact,
                $photos_string
            );

            if ($stmt->execute()) {
                $message = "<div class='success-message'>Your accident report has been successfully submitted.</div>";

                $accident_details = "
                    Dear User,
                    
                    Your accident report has been successfully submitted.
                    
                    Accident Details:
                    - Date and Time: $accident_date_time
                    - Location: $location
                    - Vehicle Number: $vehicle_number
                    - Description: $description
                    - Contact Number: $contact
                    
                    Thank you for reporting your accident to BRTA.
                ";

                $message .= "<pre style='text-align: left;'>$accident_details</pre>";
            } else {
                $message = "<div class='error-message'>Error: Unable to save your data. Please try again.</div>";
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
    <title>Accident Report Confirmation</title>
    <style>
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
        .success-message, .error-message {
            font-size: 20px;
            text-align: center;
            margin: 20px auto;
            padding: 15px 20px;
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
        pre {
            background:rgb(194, 165, 226);
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            max-width: 50%;
            margin: 10px auto;
            overflow: auto;
        }
    </style>
    </style>
</head>
<body>
    <header>
        <h1>BRTA Service Portal</h1>
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
