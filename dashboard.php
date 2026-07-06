<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit();
}

/* LOGOUT */
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

$message = "";

/* HANDLE USERS */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // DELETE USER
    if (isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        $conn->query("DELETE FROM users WHERE id=$id");
        $message = "User deleted successfully";
    }

    // UPDATE USER
    if (isset($_POST['update'])) {
        $id = (int)$_POST['id'];
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);

        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
        $message = "User updated successfully";
    }
}

/* USERS */
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");

/* DONATIONS */
$donations = $conn->query("
    SELECT donation_id, name, amount, donation_date 
    FROM donations 
    ORDER BY donation_date DESC
");

/* TOTAL DONATIONS */
$totalResult = $conn->query("SELECT SUM(amount) AS total FROM donations");
$totalDonations = $totalResult->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TLF Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Poppins',sans-serif;background:#f6fbff;color:#162033;font-size:13px;}

.topbar{
  background:#062b59;
  color:#fff;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:14px 25px;
}

.brand{display:flex;align-items:center;gap:10px;}
.brand img{width:40px;background:#fff;padding:4px;border-radius:6px;}

.btn{
  padding:8px 14px;
  border-radius:999px;
  text-decoration:none;
  font-weight:700;
}

.btn.white{background:#fff;color:#062b59;}
.btn.green{background:#2f8f3a;color:#fff;}

.container{width:90%;margin:25px auto;}

.stats{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:15px;
  margin-bottom:20px;
}

.card{
  background:#fff;
  padding:18px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.number{font-size:22px;font-weight:900;color:#062b59;}

.grid{
  display:grid;
  grid-template-columns:1.3fr 1fr;
  gap:20px;
}

.panel{
  background:#fff;
  padding:20px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

table{
  width:100%;
  border-collapse:collapse;
}

th,td{
  padding:10px;
  border-bottom:1px solid #eee;
  font-size:12px;
}

th{background:#f2f6ff;color:#062b59;}

input{
  width:100%;
  padding:5px;
  border:1px solid #ccc;
  border-radius:6px;
}

button{
  padding:6px 10px;
  border:none;
  border-radius:6px;
  cursor:pointer;
}

.update{background:#2f8f3a;color:#fff;}
.delete{background:#d62828;color:#fff;}

.message{
  background:#e7f7ea;
  padding:10px;
  margin-bottom:15px;
  border-left:5px solid #2f8f3a;
  color:#2f8f3a;
}
</style>
</head>

<body>

<div class="topbar">
  <div class="brand">
    <img src="thelogo.png">
    <h2>Admin Dashboard</h2>
  </div>

  <div>
    <a class="btn white" href="home_dashboard.php">View Site</a>
    <a class="btn green" href="?logout=1">Logout</a>
  </div>
</div>

<div class="container">

<?php if($message): ?>
  <div class="message"><?= $message ?></div>
<?php endif; ?>

<!-- STATS -->
<div class="stats">
  <div class="card">
    <h4>Total Users</h4>
    <div class="number"><?= $users->num_rows ?></div>
  </div>

  <div class="card">
    <h4>Total Donations</h4>
    <div class="number">R<?= number_format($totalDonations,2) ?></div>
  </div>

  <div class="card">
    <h4>Volunteer Applications</h4>
    <div class="number">24</div>
  </div>

  <div class="card">
    <h4>Program Participants</h4>
    <div class="number">31</div>
  </div>
</div>

<div class="grid">

<!-- USERS -->
<div class="panel">
<h3>Users Management</h3>
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Email</th>
  <th>Actions</th>
</tr>

<?php while($u = $users->fetch_assoc()): ?>
<tr>
<form method="POST">
  <td><?= $u['id'] ?></td>
  <td><input name="name" value="<?= htmlspecialchars($u['name']) ?>"></td>
  <td><input name="email" value="<?= htmlspecialchars($u['email']) ?>"></td>
  <td>
    <input type="hidden" name="id" value="<?= $u['id'] ?>">
    <button class="update" name="update">Update</button>
    <button class="delete" name="delete" onclick="return confirm('Delete user?')">Delete</button>
  </td>
</form>
</tr>
<?php endwhile; ?>

</table>
</div>

<!-- DONATIONS -->
<div class="panel">
<h3>Recent Donations</h3>
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Amount</th>
  <th>Date</th>
</tr>

<?php while($d = $donations->fetch_assoc()): ?>
<tr>
  <td><?= $d['donation_id'] ?></td>
  <td><?= htmlspecialchars($d['name']) ?></td>
  <td>R<?= number_format($d['amount'],2) ?></td>
  <td><?= date("d M Y H:i", strtotime($d['donation_date'])) ?></td>
</tr>
<?php endwhile; ?>

</table>
</div>

</div>
</div>

</body>
</html>