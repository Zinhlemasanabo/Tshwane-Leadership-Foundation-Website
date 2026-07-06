<?php
session_start();
require_once "connect.php";

if (!isset($_SESSION['name'])) {
    die("You must be logged in to donate.");
}

if (!isset($_POST['amount'])) {
    die("Invalid donation amount.");
}

$username = $_SESSION['name'];

// Ensure the amount is a number and positive
$amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
if ($amount === false || $amount <= 0) {
    die("Invalid donation amount.");
}

// Optional: Round to 2 decimals
$amount = round($amount, 2);

// Save donation
$stmt = $conn->prepare("INSERT INTO donations (name, amount) VALUES (?, ?)");
$stmt->bind_param("sd", $username, $amount);

$success = false;
$message = "";

if ($stmt->execute()) {
    $success = true;
    $message = "Thank you, " . htmlspecialchars($username) . ", for your generous donation of R" . htmlspecialchars($amount) . "!";
} else {
    $message = "Error saving donation: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donation Confirmation</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f6fbff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

body {
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Background image + gradient overlay */
    background: linear-gradient(
                    rgba(6, 43, 89, 0.7), 
                    rgba(6, 43, 89, 0.8)
                ),
                url('homepage.jpg') no-repeat center center;
    background-size: cover;
    position: relative;
    overflow: hidden;
    padding: 20px;
}


body::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, rgba(0,0,0,0.1) 100%);
    animation: moveOverlay 20s linear infinite;
    pointer-events: none; /* doesn’t interfere with clicks */
}

@keyframes moveOverlay {
    0% { transform: translate(0, 0); }
    50% { transform: translate(50px, 50px); }
    100% { transform: translate(0, 0); }
}

.confirmation-container {
    background: #fff;
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    text-align: center;
    max-width: 500px;
    width: 100%;
}

.confirmation-container h1 {
    color: #2f8f3a;
    font-size: 32px;
    margin-bottom: 20px;
}

.confirmation-container p {
    color: #062b59;
    font-size: 18px;
    margin-bottom: 30px;
}

.back-btn {
    display: inline-block;
    padding: 15px 25px;
    background: #062b59;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    text-decoration: none;
    cursor: pointer;
    transition: 0.3s;
}

.back-btn:hover {
    background: #0a3a73;
    transform: translateY(-2px);
}
</style>
</head>
<body>

<div class="confirmation-container">
    <?php if ($success): ?>
        <h1>Donation Successful!</h1>
    <?php else: ?>
        <h1>Oops!</h1>
    <?php endif; ?>
    <p><?php echo $message; ?></p>
    <a href="home_dashboard.php" class="back-btn">Done</a>
</div>

</body>
</html>