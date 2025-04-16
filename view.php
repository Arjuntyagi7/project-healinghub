<?php
include 'db_connect.php'; // Include database connection

$sql = "SELECT * FROM appointments ORDER BY id DESC"; // Fetch latest first
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
            margin: 0;
            overflow-x: hidden;
        }

        .container {
            max-width: 100%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
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

        @media screen and (max-width: 768px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th,
            td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="video-container">
        <video autoplay loop muted>
            <source src="game.mp4" type="video/mp4">
        </video>
    </div>
    <div class="container">
        <h2>Appointments List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Doctor</th>
                <th>Phone</th>
                <th>Appointment Time</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['firstName']}</td>
                            <td>{$row['lastName']}</td>
                            <td>{$row['doctor']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['appointmentTime']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No appointments found</td></tr>";
            }
            ?>
        </table>
        <a href="index.html" class="back-btn">Back to Home</a>
    </div>

</body>

</html>

<?php
$conn->close();
?>
