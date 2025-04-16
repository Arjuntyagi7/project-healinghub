<?php
include 'db_connect.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $doctor = $_POST['doctor'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $appointmentTime = $_POST['appointmentTime'];

    $sql = "INSERT INTO appointments (firstName, lastName, doctor, dob, phone, email, address, appointmentTime)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $firstName, $lastName, $doctor, $dob, $phone, $email, $address, $appointmentTime);

    if ($stmt->execute()) {
        header("Location: view.php"); // Redirect to view page after submission
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

