<?php
require_once('../model/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateTime = $_POST['accident_date_time'] ?? '';
    $location = $_POST['location'] ?? '';
    $vehicleNumber = $_POST['vehicle_number'] ?? '';
    $description = $_POST['description'] ?? '';
    $contact = $_POST['contact'] ?? '';

    if (empty($dateTime) || empty($location) || empty($vehicleNumber) || empty($description) || empty($contact)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required!']);
        exit();
    }

    $photos = [];
    if (!empty($_FILES['photos']['name'][0])) {
        $uploadDir = '../uploads/';
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
            $filename = basename($_FILES['photos']['name'][$key]);
            $targetFile = $uploadDir . $filename;
            if (move_uploaded_file($tmpName, $targetFile)) {
                $photos[] = $targetFile;
            }
        }
    }

    $conn = getConnection();
    $sql = "INSERT INTO accidents (accident_date_time, location, vehicle_number, description, photos, contact) 
            VALUES ('$dateTime', '$location', '$vehicleNumber', '$description', '" . json_encode($photos) . "', '$contact')";

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
