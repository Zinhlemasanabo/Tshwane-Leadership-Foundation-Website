<?php
session_start();
include 'connect.php';

// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

/* =========================
   DONATIONS (DATABASE)
   ========================= */
$donations = $conn->query("
    SELECT donation_id, name, amount, donation_date
    FROM donations
    ORDER BY donation_date DESC
");

$totalResult = $conn->query("
    SELECT SUM(amount) AS total
    FROM donations
");

$totalDonations = $totalResult->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TLF Staff Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
:root{
  --navy:#062b59;
  --navy2:#0a3a73;
  --green:#2f8f3a;
  --sky:#eef6fb;
  --text:#162033;
  --muted:#5d6877;
  --line:#dce6ef;
  --shadow:0 12px 30px rgba(0,0,0,0.08);
}

*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Poppins',sans-serif;background:#f6fbff;color:var(--text);}

.topbar{
  background:var(--navy);
  color:#fff;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:14px 28px;
  position:sticky;
  top:0;
}

.brand{display:flex;gap:12px;align-items:center;}
.brand img{width:46px;background:#fff;border-radius:8px;padding:4px;}
.brand h1{font-size:1.1rem;font-weight:900;}

.top-actions{display:flex;gap:10px;}
.site-btn,.logout-btn{
  padding:10px 16px;
  border-radius:999px;
  font-weight:800;
  text-decoration:none;
  font-size:0.85rem;
}
.site-btn{background:#fff;color:var(--navy);}
.logout-btn{background:var(--green);color:#fff;}

.container{width:min(1100px,90%);margin:25px auto;}

.welcome{
  background:linear-gradient(135deg,var(--navy),var(--navy2));
  color:#fff;
  padding:28px;
  border-radius:18px;
  margin-bottom:20px;
}

.stats{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:15px;
  margin-bottom:20px;
}

.stat-card{
  background:#fff;
  border:1px solid var(--line);
  border-radius:16px;
  padding:18px;
  box-shadow:var(--shadow);
}

.stat-card h3{
  font-size:0.8rem;
  color:var(--muted);
}

.stat-card .number{
  font-size:2rem;
  font-weight:900;
  color:var(--navy);
}

.grid{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:18px;
}

.panel{
  background:#fff;
  border:1px solid var(--line);
  border-radius:18px;
  padding:20px;
  box-shadow:var(--shadow);
}

table{
  width:100%;
  border-collapse:collapse;
}

th,td{
  padding:12px;
  border-bottom:1px solid #e8eef5;
  font-size:0.85rem;
}

th{
  background:#f8fbff;
  color:var(--navy);
  font-weight:900;
}

.quick-item{
  background:#f8fbff;
  border:1px solid var(--line);
  border-radius:14px;
  padding:12px;
  margin-bottom:10px;
}

.quick-item strong{
  display:block;
  color:var(--navy);
  margin-bottom:4px;
}

.quick-item a{
  color:var(--green);
  font-weight:700;
  text-decoration:none;
}

@media(max-width:900px){
  .stats,.grid{grid-template-columns:1fr;}
}
</style>
</head>

<body>

<header class="topbar">
  <div class="brand">
    <img src="thelogo.png" alt="TLF Logo">
    <h1>TLF Staff Dashboard</h1>
  </div>

  <div class="top-actions">
    <a href="home_dashboard.php" class="site-btn">View Website</a>
    <a href="?logout=1" class="logout-btn">Logout</a>
  </div>
</header>

<main class="container">

<!-- WELCOME -->
<section class="welcome">
  <h2>Welcome Staff Member</h2>
  <p>Track volunteers, programmes, and donations in real time.</p>
</section>

<!-- STATS (RESTORED EXACT STRUCTURE) -->
<section class="stats">
  <div class="stat-card">
    <h3>Volunteer Applications</h3>
    <div class="number">24</div>
  </div>

  <div class="stat-card">
    <h3>Donation Enquiries</h3>
    <div class="number">12</div>
  </div>

  <div class="stat-card">
    <h3>Programme Participants</h3>
    <div class="number">31</div>
  </div>

  <div class="stat-card">
    <h3>Donations</h3>
    <div class="number">R<?php echo number_format($totalDonations, 2); ?></div>
  </div>
</section>

<!-- GRID -->
<section class="grid">

  <!-- DONATIONS TRACKING (NEW - ADDED ONLY) -->
  <div class="panel">
    <h2>Live Donations</h2>

    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Date</th>
      </tr>

      <?php if ($donations && $donations->num_rows > 0): ?>
        <?php while($row = $donations->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['donation_id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td>R<?php echo number_format($row['amount'], 2); ?></td>
            <td><?php echo date("d M Y H:i", strtotime($row['donation_date'])); ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4">No donations found</td>
        </tr>
      <?php endif; ?>

    </table>
  </div>

  <!-- QUICK ACTIONS (RESTORED EXACT) -->
  <aside class="panel">
    <h2>Quick Actions</h2>

    <div class="quick-item">
      <strong>Google Form</strong>
      <a href="https://forms.gle/G5uPdsZa6APa5qQ98" target="_blank">
        Open Form
      </a>
    </div>

    <div class="quick-item">
      <strong>Responses</strong>
      Check Google Sheets for submissions
    </div>

    <div class="quick-item">
      <strong>Follow Up</strong>
      Contact donors via email
    </div>

  </aside>

</section>

</main>

</body>
</html>