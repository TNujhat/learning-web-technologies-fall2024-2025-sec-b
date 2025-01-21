<?php
require_once('../model/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        empty($_POST['name']) || empty($_POST['nid']) || empty($_POST['email']) || 
        empty($_POST['phone']) || empty($_POST['address']) || empty($_POST['vehicletype']) || 
        empty($_POST['reg_num']) || empty($_POST['start_point']) || empty($_POST['end_point'])
    ) {
        echo json_encode(['success' => false, 'error' => 'All fields are required!']);
        exit();
    }

    $name = trim($_POST['name']);
    $nid = trim($_POST['nid']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $vehicletype = trim($_POST['vehicletype']);
    $regNum = trim($_POST['reg_num']);
    $startPoint = trim($_POST['start_point']);
    $endPoint = trim($_POST['end_point']);
    
    $vehicleRegDoc = $_FILES['vehicleRegDoc']['name'];
    $insuranceCert = $_FILES['insuranceCert']['name'];

    $uploadDir = '../uploads/';
    move_uploaded_file($_FILES['vehicleRegDoc']['tmp_name'], $uploadDir . $vehicleRegDoc);
    move_uploaded_file($_FILES['insuranceCert']['tmp_name'], $uploadDir . $insuranceCert);

    $conn = getConnection();
    $sql = "INSERT INTO permit_appliers (name, nid, email, phone, address, vehicletype, reg_num, start_point, end_point, vehicleRegDoc, insuranceCert)
            VALUES ('{$name}', '{$nid}', '{$email}', '{$phone}', '{$address}', '{$vehicletype}', '{$regNum}', '{$startPoint}', '{$endPoint}', '{$vehicleRegDoc}', '{$insuranceCert}')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }

    mysqli_close($conn);
    exit();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit();
}
?>
