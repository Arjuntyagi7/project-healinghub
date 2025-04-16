<?php
// Include the DB connection
include 'db_connect.php';

// Get data from the form
$email = $_POST['patient_email'];
$report = $_POST['report'];

// Prepare and insert into DB
$sql = "INSERT INTO reports (email, report, submitted_at) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $report);

if ($stmt->execute()) {
    // Show the report_pending.html content directly here
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Report Status</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                margin: 0;
                background-color: #f4f4f4;
            }
            .top-logo {
                text-align: center;
                margin-top: 10px;
                z-index: 2;
                position: relative;
            }
            .top-logo img {
                height: 100px;
                width: 100px;
            }
            header {
                text-align: center;
                color: #fff;
                font-size: 28px;
                margin: 0;
                z-index: 2;
                position: relative;
            }
            .video-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }
            video {
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
            .cta-buttons {
                text-align: center;
                margin: 20px 0;
            }
            .cta-buttons a {
                text-decoration: none;
                display: inline-block;
                background-color: #007bff;
                color: #fff;
                padding: 15px 30px;
                border-radius: 5px;
                margin: 10px;
                transition: background-color 0.3s;
            }
            .cta-buttons a:hover {
                background-color: #0056b3;
            }
            .message-container {
                max-width: 600px;
                margin: 80px auto;
                background-color: #ffffffd9;
                padding: 30px;
                border-radius: 8px;
                text-align: center;
                box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
            }
            .message-container h2 {
                color: #007bff;
            }
        </style>
    </head>
    <body>
        <div class="top-logo">
            <img src="logo.png" alt="Healing Hub Logo">
        </div>

        <header>
            <h1>HEALING HUB</h1>
        </header>

        <div class="video-container">
            <video autoplay loop muted>
                <source src="game.mp4" type="video/mp4">
            </video>
        </div>

        <div class="cta-buttons">
            <a href="index.html">Back to Home</a>
            <a href="APPOINTMENT.HTML">Book Appointment</a>
            <a href="view.php">View Appointment</a>
            <a href="contact.html">Contact Info of Doctors</a>
        </div>

        <div class="message-container">
            <h2>Report Request Submitted!</h2>
            <p>The requested reports will be sent to the given email if already generated within 1 day.<br>
            If not generated yet, it may take up to 7 days.<br><br>Thank you for your patience.</p>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "<h2>Error submitting report request</h2>";
    echo "<p>" . htmlspecialchars($stmt->error) . "</p>";
}

// Close connection
$stmt->close();
$conn->close();
?>
