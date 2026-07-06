<?php
session_start();
if (!isset($_SESSION['name'])) {
    die("You must be logged in to donate.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donate</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
        linear-gradient(rgba(6,43,89,0.75), rgba(6,43,89,0.85)),
        url('homepage.jpg') no-repeat center center;

    background-size:cover;
    position:relative;

    overflow-x:hidden;
    padding:20px;
}

/* BACKGROUND OVERLAY */
body::after{
    content:"";
    position:fixed;
    inset:0;
    background:radial-gradient(circle, rgba(255,255,255,0.06), rgba(0,0,0,0.18));
    animation:moveOverlay 25s linear infinite;
    pointer-events:none;
    z-index:0;
}

@keyframes moveOverlay{
    0%{transform:translate(0,0);}
    50%{transform:translate(40px,40px);}
    100%{transform:translate(0,0);}
}

/* DONATION SECTION */
.donation-section{
    position:relative;
    z-index:2;
    width:100%;
    display:flex;
    justify-content:center;
}

.donation-container{
    width:100%;
    max-width:520px;

    background:rgba(255,255,255,0.92);
    backdrop-filter:blur(12px);

    padding:40px;
    border-radius:18px;

    box-shadow:0 15px 40px rgba(0,0,0,0.15);
    text-align:center;
}

h2{
    color:#062b59;
    font-size:28px;
    margin-bottom:10px;
}

p{
    color:#5d6877;
    margin-bottom:25px;
}

/* AMOUNT BUTTONS */
.amount-buttons{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    justify-content:center;
    margin-bottom:20px;
}

.amount-btn{
    border:2px solid #dce6ef;
    background:#fff;
    padding:12px 18px;
    border-radius:999px;
    font-weight:700;
    cursor:pointer;
    transition:0.25s;
    color:#062b59;
}

.amount-btn:hover{
    background:#eef6fb;
}

.amount-btn.active{
    background:#2f8f3a;
    color:#fff;
    border-color:#2f8f3a;
}

/* CUSTOM INPUT */
.custom-box{
    display:flex;
    align-items:center;
    gap:10px;
    background:#eef6fb;
    padding:12px 16px;
    border-radius:999px;
    margin-bottom:25px;
}

.custom-box span{
    font-weight:800;
    color:#2f8f3a;
}

.custom-box input{
    border:none;
    outline:none;
    background:transparent;
    width:100%;
    font-size:16px;
    font-weight:600;
    color:#062b59;
}

/* BUTTONS */
.donate-btn{
    width:100%;
    padding:15px;
    background:#062b59;
    color:#fff;
    font-size:18px;
    font-weight:800;
    border:none;
    border-radius:12px;
    cursor:pointer;
    transition:0.3s;
}

.donate-btn:hover{
    background:#0a3a73;
    transform:translateY(-2px);
}

.home-btn{
    display:block;
    margin-top:12px;
    padding:12px;
    border-radius:12px;
    border:2px solid #dce6ef;
    background:#fff;
    color:#062b59;
    font-weight:700;
    text-decoration:none;
    transition:0.3s;
}

.home-btn:hover{
    background:#eef6fb;
    border-color:#062b59;
}

/* MOBILE */
@media(max-width:500px){
    .donation-container{
        padding:25px;
    }
}
</style>
</head>

<body>

<section class="donation-section">
  <div class="donation-container">

    <h2>Support Our Work</h2>
    <p>Choose an amount or enter your own donation.</p>

    <form action="submit_donation.php" method="POST">

      <div class="amount-buttons">
        <button type="button" class="amount-btn active" data-amount="500">R500</button>
        <button type="button" class="amount-btn" data-amount="100">R100</button>
        <button type="button" class="amount-btn" data-amount="250">R250</button>
        <button type="button" class="amount-btn" data-amount="1000">R1000</button>
      </div>

      <div class="custom-box">
        <span>R</span>
        <input type="number" id="customAmount" min="1" placeholder="Enter custom amount">
      </div>

      <input type="hidden" name="amount" id="finalAmount" value="500">

      <button type="submit" class="donate-btn" id="donateBtn">
        Donate R500
      </button>

      <a href="home_dashboard.php" class="home-btn">
        ← Back to Home
      </a>

    </form>

  </div>
</section>

<script>
const amountButtons = document.querySelectorAll('.amount-btn');
const customInput = document.getElementById('customAmount');
const finalAmount = document.getElementById('finalAmount');
const donateBtn = document.getElementById('donateBtn');

amountButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        amountButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const amount = btn.dataset.amount;
        finalAmount.value = amount;
        donateBtn.textContent = `Donate R${amount}`;

        customInput.value = '';
    });
});

customInput.addEventListener('input', () => {
    const val = parseInt(customInput.value);

    if(val > 0){
        amountButtons.forEach(b => b.classList.remove('active'));
        finalAmount.value = val;
        donateBtn.textContent = `Donate R${val}`;
    }
});
</script>

</body>
</html>