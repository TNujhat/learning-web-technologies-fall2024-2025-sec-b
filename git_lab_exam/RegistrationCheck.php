<?php
session_start();


if (isset($_POST['submit'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($gender) && !empty($dob) && !empty($password)) {
        
        $_SESSION['user_data'] = [
            'Name' => $fname . ' ' . $lname,  
            'Email' => $email,
            'Phone' => $phone,
            'Gender' => $gender,
            'Date of Birth' => $dob,
            'Password' => $password  
        ];

        echo "<h3>Registration is Successful!</h3>";
        echo "<a href='login.html'>Next</a>";
        exit();
    } else {
        echo "All fields are required. Please fill out the form completely.";
    }
}
?>
