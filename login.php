<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if user exists using prepared statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            echo "<script>alert('Login successful!'); window.location.href='medical_report.html';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid email or password.'); window.location.href='logic.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('User not found. Please sign up first.'); window.location.href='signup.html';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
