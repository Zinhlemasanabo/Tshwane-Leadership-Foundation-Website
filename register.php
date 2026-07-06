<?php
session_start();
include 'connect.php';

$message = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 3; // New users get role 3

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Email already exists!";
    } else {
        // Include role in insert query
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssi", $name, $email, $password, $role);

        if ($stmt->execute()) {
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $name;

            header("Location: login.php");
            exit();
        } else {
            $message = "Registration failed! " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TLF Register</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

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

.error-message{
  margin-top:12px;
  padding:10px;
  border-radius:12px;
  background:#fff0f0;
  color:#b42318;
  font-size:.82rem;
  text-align:center;
  font-weight:600;
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
    <p>Registration</p>
  </div>

  <?php if(!empty($message)){ ?>
    <div class="error-message">
      <?php echo $message; ?>
    </div>
  <?php } ?>

  <form method="POST">

    <div class="input-group">
      <label>Full Name</label>
      <input type="text" name="fullname" required>
    </div>

    <div class="input-group">
      <label>Email Address</label>
      <input type="email" name="email" required>
    </div>

    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>

    <button type="submit" name="register" class="login-btn">
      Create Account
    </button>

  </form>

  <div class="back-home">
    Already have an account? <a href="login.php">Login here</a>
  </div>

</div>

</body>
</html>