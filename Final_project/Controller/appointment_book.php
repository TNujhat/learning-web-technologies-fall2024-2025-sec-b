<?php
require_once('../model/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (empty($data['name']) || empty($data['dob']) || empty($data['gender']) || empty($data['phone']) || 
        empty($data['email']) || empty($data['address']) || empty($data['appointment_time']) || 
        empty($data['instructor']) || empty($data['coursetype']) || empty($data['location']) || empty($data['nid'])) {
        echo json_encode(['success' => false, 'error' => 'All fields are required!']);
        exit();
    }
    $name = trim($data['name']);
    $dob = trim($data['dob']);
    $gender = trim($data['gender']);
    $phone = trim($data['phone']);
    $email = trim($data['email']);
    $address = trim($data['address']);
    $appointment_time = trim($data['appointment_time']);
    $instructor = trim($data['instructor']);
    $course_type = trim($data['coursetype']);
    $location = trim($data['location']);
    $nid = trim($data['nid']);

    $conn = getConnection();
    $sql = "INSERT INTO appointment_bookings (name, dob, gender, phone, email, address, appointment_time, instructor, course_type, location, nid)  
            VALUES ('{$name}', '{$dob}', '{$gender}', '{$phone}', '{$email}', '{$address}', '{$appointment_time}', '{$instructor}', '{$course_type}', '{$location}', '{$nid}')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error: ' . mysqli_error($conn)]);
    }

    mysqli_close($conn);
    exit();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit();
}
?>
