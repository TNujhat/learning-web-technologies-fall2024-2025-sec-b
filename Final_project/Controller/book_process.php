<?php
session_start();
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $appointment_time = $_POST['appointment_time'];
    $instructor = $_POST['instructor'];
    $course_type = $_POST['coursetype'];
    $location = $_POST['location'];
    $nid = $_POST['nid'];

 
    if (empty($name) || empty($dob) || empty($gender) || empty($phone) || empty($email) || empty($address) || empty($appointment_time) || empty($instructor) || empty($course_type) || empty($location) || empty($nid)) {
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
                "INSERT INTO appointment_bookings (name, dob, gender, phone, email, address, appointment_time, instructor, course_type, location, nid) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "sssssssssss",
                $name,
                $dob,
                $gender,
                $phone,
                $email,
                $address,
                $appointment_time,
                $instructor,
                $course_type,
                $location,
                $nid
            );

            if ($stmt->execute()) {
                $message = "<div class='success-message'>Your appointment has been successfully booked.</div>";

     
                $appointment_details = "
                    Dear $name,
                    
                    Your appointment has been successfully booked.
                    
                    Appointment Details:
                    - Date and Time: $appointment_time
                    - Instructor: $instructor
                    - Course Type: $course_type
                    - Location: $location
                    
                    Thank you for choosing BRTA Driving Services.
                ";

                $message .= "<pre style='text-align: left;'>$appointment_details</pre>";
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
    <title>Appointment Confirmation</title>
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
</head>
<body>
    <header>
        <h1>Appointment Confirmation</h1>
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
