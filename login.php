<?php
session_start();
include 'connect.php'; // mysqli connection

$message = "";
$messageType = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {

        $message = "Fields cannot be empty";
        $messageType = "error";

    } else {

        $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 0) {
                    header("Location: dashboard.php");
                    exit();
                }

                if ($user['role'] == 1) {
                    header("Location: dashboard.php");
                    exit();
                }

                if ($user['role'] == 2) {
                    header("Location: stuff.php");
                    exit();
                }

                if ($user['role'] == 3) {
                    header("Location: home_dashboard.php");
                    exit();
                }

                $message = "Invalid role assigned";
                $messageType = "error";

            } else {
                $message = "Wrong password";
                $messageType = "error";
            }

        } else {
            $message = "User not found";
            $messageType = "error";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tshwane Leadership Foundation - Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Poppins',sans-serif;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:
        linear-gradient(rgba(6,43,89,.76),rgba(6,43,89,.80)),
        url('homepage.jpg');
    background-size:cover;
    background-position:center;
    padding:20px;
}

.login-card{
    width:100%;
    max-width:420px;
    background:rgba(255,255,255,.97);
    backdrop-filter:blur(10px);
    border-radius:22px;
    padding:32px 28px;
    box-shadow:0 18px 50px rgba(0,0,0,.22);
}

.logo{
    text-align:center;
    margin-bottom:22px;
}

.logo img{
    width:82px;
    display:block;
    margin:auto;
}

.logo h1{
    color:#062b59;
    font-size:1.3rem;
    margin-top:12px;
    font-weight:800;
}

.logo p{
    color:#2f8f3a;
    font-size:.85rem;
    margin-top:6px;
    font-weight:700;
}

.input-group{
    margin-bottom:15px;
}

.input-group label{
    display:block;
    margin-bottom:7px;
    font-size:.84rem;
    font-weight:700;
    color:#062b59;
}

.input-group input{
    width:100%;
    height:48px;
    border:1px solid #dce6ef;
    border-radius:13px;
    padding:0 15px;
    font-size:.88rem;
    outline:none;
    background:#f6fbff;
    transition:.25s ease;
    font-family:inherit;
}

.input-group input:focus{
    border-color:#2f8f3a;
    background:#fff;
    box-shadow:0 0 0 4px rgba(47,143,58,.12);
}

.login-btn{
    width:100%;
    height:50px;
    border:none;
    border-radius:13px;
    background:#062b59;
    color:#fff;
    font-size:.95rem;
    font-weight:800;
    cursor:pointer;
    transition:.25s ease;
    margin-top:8px;
}

.login-btn:hover{
    background:#0a3a73;
    transform:translateY(-2px);
}

.message{
    margin-top:12px;
    padding:10px;
    border-radius:12px;
    text-align:center;
    font-size:.82rem;
    font-weight:600;
}

.message.error{
    background:#ffe5e5;
    color:#b42318;
}

.back-home{
    text-align:center;
    margin-top:16px;
}

.back-home a{
    color:#2f8f3a;
    text-decoration:none;
    font-weight:700;
    font-size:.86rem;
}
</style>

</head>
<body>

<div class="login-card">

    <div class="logo">
        <img src="thelogo.png" alt="TLF Logo">
        <h1>Tshwane Leadership Foundation</h1>
        <p>Login</p>
    </div>

    <?php if(!empty($message)) { ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="input-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" name="login" class="login-btn">Login</button>

    </form>

    <div class="back-home">
        Don't have an account? <a href="register.php">Register here</a>
    </div>

</div>

</body>
</html>