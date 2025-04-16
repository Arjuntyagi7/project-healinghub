<?php
require_once 'db.php'; // Include the database connection

// Get and sanitize input
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$amount = $_POST['amount'] ?? 0;
$transaction_id = $_POST['transaction_id'] ?? '';

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO orders (name, phone, address, amount, transaction_id, payment_method) VALUES (?, ?, ?, ?, ?, 'Cash on Delivery')");
$stmt->bind_param("sssds", $name, $phone, $address, $amount, $transaction_id);

// Execute and respond
if ($stmt->execute()) {
    http_response_code(200);
    echo "Order stored successfully!";
} else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

