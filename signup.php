<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Validate phone number (only digits, length between 10-15)
    if (!preg_match("/^\d{10,15}$/", $phone)) {
        echo "<script>alert('Invalid phone number!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Validate password strength (min 6 characters, at least one number and one special character)
    if (strlen($password) < 6 || !preg_match("/[0-9]/", $password) || !preg_match("/[\W]/", $password)) {
        echo "<script>alert('Password must be at least 6 characters long and include at least one number and one special character.'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if email already exists using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('You are already registered. Please login.'); window.location.href='login.html';</script>";
        exit();
    }
    $stmt->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Signup successful! You can now login.'); window.location.href='logic.html';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again later.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>