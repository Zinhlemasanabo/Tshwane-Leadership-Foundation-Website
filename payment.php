<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Method</title>

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

.input-group input,
.input-group select{
    width:100%;
    border:1px solid #dce6ef;
    border-radius:13px;
    padding:12px 15px;
    font-size:.88rem;
    outline:none;
    background:#f6fbff;
    transition:.25s ease;
    font-family:inherit;
}

.input-group input:focus,
.input-group select:focus{
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
        <h1>Add Payment Method</h1>
        <p>Enter your banking details</p>
    </div>

    <form>

        <div class="input-group">
            <label>Payment Type</label>
            <select name="payment_type">
                <option value="">Select Payment Type</option>
                <option value="Card Payment">Card Payment</option>
                <option value="EFT">EFT</option>
            </select>
        </div>

        <div class="input-group">
            <label>Account Number</label>
            <input type="text" name="acc_number">
        </div>

        <div class="input-group">
            <label>PIN</label>
            <input type="password" name="pin">
        </div>

        <div class="input-group">
            <label>Bank Name</label>
            <input type="text" name="bank_name">
        </div>

        <div class="input-group">
            <label>Proof of Payment (PDF/Image)</label>
            <input
                type="file"
                name="proof_of_payment"
                accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <button
            type="button"
            class="login-btn"
            onclick="window.location.href='donate.php'">
            Payment Method
        </button>

    </form>

    <div class="back-home">
        <a href="home_dashboard.php">← Back</a>
    </div>

</div>

</body>
</html>