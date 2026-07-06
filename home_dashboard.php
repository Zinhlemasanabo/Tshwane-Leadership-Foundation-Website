<?php
$conn = new mysqli("localhost", "root", "", "tshwanefoundation");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tshwane Leadership Foundation | Healthy and Vibrant Communities</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    :root{
      --navy:#062b59;
      --navy-2:#0a3a73;
      --green:#2f8f3a;
      --lime:#65b82f;
      --gold:#d8a412;
      --sky:#eef6fb;
      --white:#ffffff;
      --text:#162033;
      --muted:#5d6877;
      --line:#dce6ef;
      --shadow:0 18px 45px rgba(6,43,89,.12);
      --radius:22px;
    }

    *{margin:0;padding:0;box-sizing:border-box;}
    html{scroll-behavior:smooth;}
    body{
      font-family:'Poppins',sans-serif;
      color:var(--text);
      background:#f6fbff;
      overflow-x:hidden;
    }
    img{width:100%;display:block;}
    a{text-decoration:none;color:inherit;}
    ul{list-style:none;}
    .container{width:min(1180px,92%);margin:auto;}

    /* NAVBAR */
    .navbar{
      position:sticky;
      top:0;
      z-index:1000;
      background:#fff;
      box-shadow:0 6px 24px rgba(6,43,89,.08);
    }
    .nav-inner{
      height:82px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:26px;
    }
    .logo{
      display:flex;
      align-items:center;
      gap:12px;
      color:var(--navy);
      font-weight:900;
      line-height:1.05;
      letter-spacing:.2px;
      font-size:1.05rem;
      text-transform:uppercase;
    }
    .logo img{
      width:76px;
      height:60px;
      object-fit:contain;
    }
    .nav-links{
      display:flex;
      align-items:center;
      gap:30px;
      font-size:.95rem;
      font-weight:600;
    }
    .nav-links a{
      position:relative;
      padding:30px 0;
      color:#111827;
      transition:.25s ease;
    }
    .nav-links a::after{
      content:"";
      position:absolute;
      left:0;
      bottom:20px;
      width:0;
      height:3px;
      background:var(--navy);
      border-radius:999px;
      transition:.25s ease;
    }
    .nav-links a:hover,
    .nav-links a.active{color:var(--navy);}
    .nav-links a:hover::after,
    .nav-links a.active::after{width:100%;}
    .donate-nav{
      background:transparent;
      color:var(--navy)!important;
      padding:13px 30px!important;
      border-radius:999px;
      border:2px solid var(--navy);
      transition:all .3s ease;
    }

    .donate-nav:hover{
      transform:translateY(-3px);
      box-shadow:0 10px 24px rgba(6,43,89,.15);
    }
    .donate-nav::after{display:none;}
    .hamburger{
      display:none;
      border:0;
      background:var(--navy);
      color:#fff;
      width:48px;
      height:48px;
      border-radius:14px;
      font-size:1.6rem;
      cursor:pointer;
    }

    /* HERO */
    .hero{
      background:linear-gradient(90deg,#ffffff 0%,#ffffff 45%,#ffffff 45%,#ffffff 100%);
      position:relative;
      overflow:hidden;
    }
    .hero-wrap{
      min-height:590px;
      display:grid;
      grid-template-columns:1fr 1.18fr;
      align-items:center;
      gap:34px;
      position:relative;
    }
    .hero-copy{
      padding:70px 0 110px;
      z-index:2;
    }
    .pill{
      display:inline-flex;
      align-items:center;
      gap:10px;
      border:1.5px solid var(--green);
      border-radius:999px;
      padding:9px 17px;
      color:var(--navy);
      font-weight:600;
      background:#fff;
      margin-bottom:18px;
      font-size:.9rem;
    }
    .pill span{
      width:10px;
      height:10px;
      border-radius:50%;
      background:var(--green);
      box-shadow:0 0 0 6px rgba(47,143,58,.13);
    }
    .hero h1{
      font-size:clamp(2.8rem,5.5vw,5.45rem);
      line-height:1.02;
      color:var(--navy);
      letter-spacing:-3px;
      margin-bottom:24px;
      font-weight:900;
    }
    .hero h1 .green{color:var(--green);}
    .hero h1 .gold{color:var(--gold);}
    .hero p{
      color:#263245;
      font-size:1.02rem;
      line-height:1.68;
      max-width:610px;
      margin-bottom:28px;
    }
    .hero-actions{
      display:flex;
      align-items:center;
      gap:24px;
      flex-wrap:wrap;
    }
    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      border-radius:999px;
      padding:15px 34px;
      font-weight:800;
      transition:.28s ease;
      border:2px solid transparent;
      cursor:pointer;
    }
    .btn-navy{background:var(--navy);color:#fff;box-shadow:0 12px 24px rgba(6,43,89,.22);}
    .btn-navy:hover{transform:translateY(-3px);background:var(--navy-2);}
    .btn-green{background:var(--green);color:#fff;box-shadow:0 12px 24px rgba(47,143,58,.18);}
    .btn-green:hover{transform:translateY(-3px);background:#267c31;}
    .btn-outline{border-color:#fff;color:#fff;background:transparent;}
    .btn-outline:hover{background:#fff;color:var(--navy);}
    .ubuntu-sign{
      color:var(--green);
      font-family:cursive;
      font-size:1.7rem;
      transform:rotate(-4deg);
      border-bottom:3px solid var(--green);
      padding-bottom:3px;
    }
    .hero-image{
      position:relative;
      height:890px;
      width: max-content;
      border-bottom-left-radius:0px;
      overflow:hidden;
      box-shadow:var(--shadow);
    }
    .hero-image::before{
      content:"";
      position:absolute;
      background:linear-gradient(90deg,rgba(255,255,255,0.78) 0%,rgba(255,255,255,0.42) 55%,rgba(255,255,255,0) 100%);
      inset:0;
      
      z-index:1;
    }
    .hero-image img{height:100%;object-fit:cover;object-position:center;}

    /* IMPACT BAR */
    .impact-bar{
      margin-top:-64px;
      position:relative;
      z-index:5;
    }
    .impact-card{
      background:var(--navy);
      color:#fff;
      border-radius:12px;
      box-shadow:0 18px 35px rgba(6,43,89,.25);
      display:grid;
      grid-template-columns:repeat(3,1fr);
      overflow:hidden;
    }
    .impact-item{
      display:flex;
      align-items:center;
      gap:22px;
      padding:26px 55px;
      min-height:110px;
      position:relative;
    }
    .impact-item:not(:last-child)::after{
      content:"";
      position:absolute;
      right:0;
      top:28px;
      bottom:28px;
      width:1px;
      background:rgba(101,184,47,.75);
    }
    .impact-icon{
      font-size:2.45rem;
      color:var(--lime);
      line-height:1;
    }
    .impact-item strong{
      font-size:2.65rem;
      line-height:1;
      font-weight:900;
      display:block;
    }
    .impact-item span{font-size:.92rem;color:rgba(255,255,255,.9);}

    /* GENERAL SECTIONS */
    section{padding:72px 0;}
    .section-head{text-align:center;margin-bottom:30px;}
    .mini-title{
      text-transform:uppercase;
      color:var(--green);
      font-weight:900;
      letter-spacing:.7px;
      font-size:.86rem;
      margin-bottom:4px;
    }
    .section-head h2,
    .about h2{
      color:var(--navy);
      font-size:clamp(2rem,3.5vw,3rem);
      line-height:1.1;
      font-weight:900;
      letter-spacing:-1px;
    }
    .underline{
      width:62px;
      height:4px;
      background:var(--gold);
      margin:12px auto 0;
      border-radius:999px;
    }

    /* PROGRAMMES */
    .programmes{background:#f6fbff;padding-top:34px;}
    .programme-grid{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:24px;
    }
    .programme-card{
      background:#fff;
      border-radius:16px;
      overflow:hidden;
      box-shadow:0 12px 30px rgba(6,43,89,.10);
      transition:.28s ease;
    }
    .programme-card:hover{transform:translateY(-8px);box-shadow:0 20px 44px rgba(6,43,89,.16);}
    .programme-card img{height:178px;object-fit:cover;}
    .programme-body{
      padding:24px 24px 28px;
      position:relative;
    }
    .circle-icon{
      width:58px;
      height:58px;
      border-radius:50%;
      display:grid;
      place-items:center;
      background:var(--navy);
      color:#fff;
      border:5px solid #fff;
      font-size:1.45rem;
      position:absolute;
      top:-33px;
      left:24px;
      box-shadow:0 8px 20px rgba(6,43,89,.2);
    }
    .programme-body h3{color:var(--navy);font-size:1.28rem;margin:12px 0 8px;font-weight:900;}
    .programme-body p{color:#2b3545;line-height:1.55;font-size:.95rem;}



    .programme-intro{max-width:880px;margin:0 auto 34px;text-align:center;color:#2b3545;line-height:1.75;}
    .programme-detail-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:34px;}
    .detail-card{background:#fff;border:1px solid var(--line);border-radius:18px;padding:24px;box-shadow:0 10px 24px rgba(6,43,89,.08);transition:.25s ease;}
    .detail-card:hover{transform:translateY(-6px);box-shadow:0 18px 40px rgba(6,43,89,.13);}
    .detail-card .status{display:inline-flex;margin-bottom:12px;padding:6px 12px;border-radius:999px;background:#eef8ef;color:var(--green);font-weight:800;font-size:.76rem;text-transform:uppercase;letter-spacing:.4px;}
    .detail-card h3{color:var(--navy);font-size:1.18rem;margin-bottom:10px;font-weight:900;}
    .detail-card p{color:#2b3545;line-height:1.65;font-size:.92rem;margin-bottom:14px;}
    .detail-card .phone{color:var(--green);font-weight:800;font-size:.92rem;}
    .service-feature{background:#fff;padding:72px 0;}
    .feature-card{display:grid;grid-template-columns:.9fr 1.1fr;gap:34px;align-items:center;background:linear-gradient(135deg,var(--navy),var(--navy-2));color:#fff;border-radius:24px;padding:38px;box-shadow:var(--shadow);}
    .feature-card img{height:360px;object-fit:cover;border-radius:18px;}
    .feature-card h2{font-size:clamp(1.8rem,3vw,2.7rem);line-height:1.1;margin-bottom:12px;}
    .feature-card p{color:rgba(255,255,255,.9);line-height:1.75;margin-bottom:14px;}
    .feature-list{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:18px;}
    .feature-list span{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.14);border-radius:12px;padding:12px;font-size:.9rem;}
    .donate-section{background:#f6fbff;padding:72px 0;}
    .donate-grid{display:grid;grid-template-columns:1fr 1fr;gap:26px;align-items:stretch;}
    .donate-box,.bank-box{background:#fff;border-radius:22px;padding:32px;border:1px solid var(--line);box-shadow:0 12px 30px rgba(6,43,89,.09);}
    .donate-box h2,.bank-box h3{color:var(--navy);font-weight:900;margin-bottom:12px;}
    .donate-box p,.bank-box p{color:#2b3545;line-height:1.75;margin-bottom:12px;}
    .need-list{margin-top:12px;display:grid;gap:10px;}
    .need-list li{background:#eef6fb;border-radius:12px;padding:12px 14px;font-weight:700;color:var(--navy);}
    .bank-row{display:flex;justify-content:space-between;gap:20px;border-bottom:1px solid var(--line);padding:12px 0;color:#2b3545;}
    .bank-row strong{color:var(--navy);}
    .festival{background:#fff;padding:72px 0;}
    .festival-card{display:grid;grid-template-columns:1.05fr .95fr;gap:34px;align-items:center;background:#eef6fb;border-radius:24px;overflow:hidden;box-shadow:var(--shadow);}
    .festival-copy{padding:38px;}
    .festival-copy h2{color:var(--navy);font-size:clamp(1.9rem,3vw,2.8rem);line-height:1.1;margin-bottom:12px;}
    .festival-copy p{color:#2b3545;line-height:1.75;margin-bottom:14px;}
    .festival-copy .big-number{font-weight:900;color:var(--green);font-size:1.25rem;}
    .festival img{height:420px;object-fit:cover;}

    /* ABOUT */
    .about{background:#f6fbff;padding-top:28px;}
    .about-grid{
      display:grid;
      grid-template-columns:1fr 1.15fr;
      gap:58px;
      align-items:center;
    }
    .about h2 .green{color:var(--green);}
    .about .underline{margin:16px 0 20px;}
    .about p{color:#2b3545;line-height:1.75;margin-bottom:18px;}
    .about-image img{
      border-radius:18px;
      height:340px;
      object-fit:cover;
      box-shadow:var(--shadow);
    }

    /* GALLERY */
    .gallery{background:#f6fbff;padding-top:8px;}
    .gallery-row{
      display:grid;
      grid-template-columns:repeat(5,1fr);
      gap:18px;
      margin-top:30px;
    }
    .gallery-row img{
      height:135px;
      object-fit:cover;
      border-radius:14px;
      box-shadow:0 10px 22px rgba(6,43,89,.10);
      transition:.25s ease;
    }
    .gallery-row img:hover{transform:translateY(-5px) scale(1.02);}
    .gallery-btn{text-align:center;margin-top:26px;}
    .btn-gallery{
      border:2px solid var(--navy);
      color:var(--navy);
      background:#fff;
      min-width:260px;
      padding:12px 28px;
      border-radius:8px;
      font-weight:800;
      display:inline-flex;
      justify-content:center;
    }
    .btn-gallery:hover{background:var(--navy);color:#fff;}

    /* CTA */
    .cta{
      background:var(--navy);
      color:#fff;
      padding:30px 0;
      position:relative;
      overflow:hidden;
    }
    .cta::before{
      content:"";
      position:absolute;
      inset:0;
      background:linear-gradient(90deg,rgba(47,143,58,.18),transparent 34%);
    }
    .cta-grid{
      position:relative;
      display:grid;
      grid-template-columns:90px 1fr auto;
      align-items:center;
      gap:26px;
    }
    .cta-icon{font-size:3.3rem;color:var(--lime);}
    .cta h2{font-size:1.85rem;margin-bottom:4px;}
    .cta p{color:rgba(255,255,255,.9);max-width:720px;}
    .cta-actions{display:flex;gap:16px;flex-wrap:wrap;}

    /* FOOTER */
    .location{
      background:#fff;
      padding:55px 0 70px;
    }
    .location-grid{
      display:grid;
      grid-template-columns:.85fr 1.15fr;
      gap:34px;
      align-items:center;
    }
    .location h2{
      color:var(--navy);
      font-size:clamp(1.8rem,3vw,2.6rem);
      line-height:1.15;
      margin-bottom:8px;
    }
    .location p{
      color:var(--muted);
      line-height:1.8;
      max-width:480px;
    }
    .map-card{
      overflow:hidden;
      border-radius:24px;
      box-shadow:var(--shadow);
      border:1px solid var(--line);
      min-height:330px;
      background:#eef6fb;
    }
    .map-card iframe{
      width:100%;
      height:330px;
      border:0;
      display:block;
    }

    .footer{
      background:#062b59;
      color:#fff;
      padding:44px 0 18px;
      border-top:1px solid rgba(255,255,255,.16);
    }
    .footer-grid{
      display:grid;
      grid-template-columns:1.35fr 1fr 1fr 1.25fr;
      gap:46px;
    }
    .footer-logo{
      display:flex;
      align-items:center;
      gap:12px;
      font-weight:900;
      text-transform:uppercase;
      line-height:1.05;
      margin-bottom:12px;
    }
    .footer-logo img{width:72px;height:60px;object-fit:contain;}
    .footer p,.footer a{color:rgba(255,255,255,.82);font-size:.92rem;line-height:1.9;}
    .footer h4{margin-bottom:14px;font-size:1rem;}
    .social-line{display:flex;align-items:center;gap:10px;margin-bottom:8px;}
    .social-icon{width:26px;height:26px;border-radius:50%;display:grid;place-items:center;background:#fff;color:var(--navy);font-size:.8rem;font-weight:900;}
    .footer-bottom{text-align:center;color:rgba(255,255,255,.75);border-top:1px solid rgba(255,255,255,.12);margin-top:30px;padding-top:16px;font-size:.86rem;}


    /* GOOGLE FORM + INTERACTIVE DONATION */
    .google-form-box{
      margin-top:24px;
      background:#fff;
      padding:12px;
      border-radius:18px;
      box-shadow:0 12px 30px rgba(6,43,89,.09);
      border:1px solid var(--line);
      overflow:hidden;
    }

    .google-form-box iframe{
      border-radius:14px;
      background:#fff;
      display:block;
    }

    .donation-buttons{
      display:flex;
      flex-wrap:wrap;
      gap:12px;
      margin:20px 0;
    }

    .amount-btn{
      border:2px solid var(--line);
      background:#fff;
      color:var(--navy);
      padding:12px 20px;
      border-radius:999px;
      font-weight:800;
      cursor:pointer;
      transition:.25s ease;
      font-family:inherit;
    }

    .amount-btn:hover,
    .amount-btn.selected{
      background:var(--green);
      color:#fff;
      border-color:var(--green);
    }

    .custom-donation{
      display:flex;
      align-items:center;
      gap:8px;
      background:#eef6fb;
      border:1px solid var(--line);
      border-radius:999px;
      padding:10px 16px;
      margin-bottom:18px;
    }

    .custom-donation span{
      font-weight:900;
      color:var(--green);
    }

    .custom-donation input{
      width:100%;
      border:none;
      outline:none;
      background:transparent;
      font-family:inherit;
      font-weight:700;
      color:var(--navy);
      font-size:1rem;
    }

    .bank-details-mini{
      margin-top:24px;
      padding:18px;
      background:#eef6fb;
      border-radius:16px;
    }

    .bank-details-mini h4{
      color:var(--navy);
      margin-bottom:10px;
    }

    .bank-details-mini p{
      margin-bottom:8px;
      font-size:.92rem;
    }

    .donation-note{
      margin-top:16px;
      font-size:.85rem;
      color:var(--muted)!important;
    }

    @media(max-width:1000px){
      .hero{background:#fff;}
      .hero-wrap{grid-template-columns:1fr;min-height:auto;}
      .hero-copy{padding:55px 0 20px;}
      .hero-image{height:420px;border-radius:24px;margin-bottom:70px;}
      .impact-card,.programme-grid,.programme-detail-grid,.about-grid,.feature-card,.donate-grid,.festival-card,.location-grid,.footer-grid{grid-template-columns:1fr;}
      .impact-item:not(:last-child)::after{display:none;}
      .impact-item{padding:24px 30px;}
      .gallery-row{grid-template-columns:repeat(2,1fr);}
      .feature-list{grid-template-columns:1fr;}
      .cta-grid{grid-template-columns:1fr;text-align:left;}
    }

    @media(max-width:840px){
      .hamburger{display:block;}
      .nav-links{
        position:absolute;
        left:4%;
        right:4%;
        top:92px;
        display:none;
        flex-direction:column;
        gap:0;
        background:#fff;
        border-radius:18px;
        box-shadow:var(--shadow);
        padding:16px;
      }
      .nav-links.show{display:flex;}
      .nav-links a{padding:14px 10px;width:100%;}
      .nav-links a::after{bottom:8px;}
      .donate-nav{margin-top:8px;text-align:center;}
      .hero h1{letter-spacing:-1.8px;}
      .ubuntu-sign{font-size:1.35rem;}
      .gallery-row{grid-template-columns:1fr;}
      .gallery-row img{height:230px;}
      
    }

    /* === RESPONSIVE SCREEN FIX === */
    html,
    body{
      width:100%;
      max-width:100%;
      overflow-x:hidden;
    }

    .container{
      width:min(1180px, 92vw);
      margin-inline:auto;
    }

    section{
      padding:clamp(42px, 6vw, 72px) 0;
    }

    .nav-inner{
      min-height:76px;
      height:auto;
      padding:10px 0;
    }

    .nav-links{
      gap:clamp(12px, 1.5vw, 30px);
      font-size:clamp(.78rem, .85vw, .95rem);
      white-space:nowrap;
    }

    .nav-links a{
      padding:12px 0;
      display:inline-flex;
      align-items:center;
    }

    .nav-links a::after{
      bottom:4px;
    }

    .donate-nav{
      padding:10px 22px !important;
      line-height:1;
    }

    .hero-wrap{
      min-height:calc(100vh - 76px);
      grid-template-columns:minmax(0, .95fr) minmax(0, 1.05fr);
      gap:clamp(22px, 3vw, 38px);
    }

    .hero-copy{
      padding:clamp(42px, 6vw, 78px) 0;
    }

    .hero h1{
      font-size:clamp(2.35rem, 5vw, 5.1rem);
      line-height:1.03;
      letter-spacing:clamp(-3px, -.25vw, -1.2px);
    }

    .hero p{
      font-size:clamp(.92rem, 1vw, 1.02rem);
      max-width:58ch;
    }

    .hero-image{
      height:min(650px, calc(100vh - 110px));
      width:100%;
      border-radius:0 0 0 26px;
      box-shadow:var(--shadow);
    }

    .impact-bar{
      margin-top:clamp(-48px, -4vw, -34px);
    }

    .impact-item{
      padding:clamp(18px, 2.3vw, 28px) clamp(22px, 3.2vw, 55px);
      min-width:0;
    }

    .programme-grid,
    .programme-detail-grid{
      grid-template-columns:repeat(3, minmax(0, 1fr));
    }

    .programme-card,
    .detail-card,
    .donate-box,
    .bank-box,
    .feature-card,
    .festival-card,
    .impact-card{
      min-width:0;
    }

    .google-form-box iframe{
      width:100%;
      height:min(650px, 78vh);
    }

    @media(max-width:1200px){
      .container{width:min(1060px, 94vw);}
      .logo{font-size:.86rem;}
      .logo img{width:62px;height:48px;}
      .nav-links{gap:12px;font-size:.78rem;}
      .donate-nav{padding:9px 16px !important;}
      .programme-detail-grid{grid-template-columns:repeat(2, minmax(0, 1fr));}
      .footer-grid{grid-template-columns:repeat(2, minmax(0, 1fr));}
    }

    @media(max-width:1000px){
      .hero{background:#fff;}
      .hero-wrap,
      .about-grid,
      .feature-card,
      .donate-grid,
      .festival-card,
      .location-grid{
        grid-template-columns:1fr;
      }

      .hero-wrap{min-height:auto;}
      .hero-copy{padding:44px 0 18px;}
      .hero-image{
        height:420px;
        margin-bottom:50px;
        border-radius:22px;
      }

      .impact-card{grid-template-columns:1fr;}
      .impact-item:not(:last-child)::after{display:none;}
      .programme-grid,
      .programme-detail-grid{grid-template-columns:repeat(2, minmax(0, 1fr));}
      .gallery-row{grid-template-columns:repeat(3, minmax(0, 1fr));}
      .cta-grid{grid-template-columns:1fr;}
      .donate-grid{grid-template-columns:1fr;}
    }

    @media(max-width:840px){
      .navbar{position:sticky;}
      .nav-inner{min-height:70px;}
      .hamburger{display:block;}

      .nav-links{
        position:absolute;
        left:4vw;
        right:4vw;
        top:78px;
        display:none;
        flex-direction:column;
        align-items:stretch;
        gap:0;
        background:#fff;
        border-radius:18px;
        box-shadow:var(--shadow);
        padding:14px;
        white-space:normal;
      }

      .nav-links.show{display:flex;}

      .nav-links a{
        width:100%;
        padding:13px 12px;
        border-radius:12px;
      }

      .nav-links a::after{display:none;}

      .nav-links a:hover,
      .nav-links a.active{
        background:#eef6fb;
        color:var(--navy);
      }

      .donate-nav{
        margin-top:8px;
        display:flex;
        justify-content:center;
        background:var(--navy) !important;
        color:#fff !important;
      }

      .hero h1{letter-spacing:-1.4px;}
      .hero-image{height:360px;}
      .programme-grid,
      .programme-detail-grid,
      .gallery-row,
      .footer-grid{
        grid-template-columns:1fr;
      }
      .gallery-row img{height:220px;}
      .feature-list{grid-template-columns:1fr;}
    }

    @media(max-width:520px){
      .container{width:92vw;}
      .logo span{font-size:.76rem;}
      .logo img{width:54px;height:42px;}
      .hamburger{width:44px;height:44px;}
      .hero-copy{padding:34px 0 12px;}
      .hero h1{font-size:2.25rem;}
      .hero-actions{gap:14px;}
      .btn{width:100%;padding:14px 22px;}
      .ubuntu-sign{font-size:1.25rem;}
      .hero-image{height:300px;margin-bottom:42px;}
      .impact-item{padding:20px;}
      .impact-item strong{font-size:2rem;}
      .programme-card img,.gallery-row img{height:200px;}
      .feature-card,.festival-copy,.donate-box,.bank-box{padding:22px;}
      .festival img,.feature-card img{height:260px;}
      .bank-row{flex-direction:column;gap:4px;}
      .map-card,.map-card iframe{height:260px;min-height:260px;}
    }
/* USER ACCOUNT BUTTON */

.user-menu{
    position:relative;
    margin-left:15px;
}

.user-btn{
    width:50px;
    height:50px;
    border-radius:50%;
    border:none;
    background:#062b59;
    color:white;
    font-size:24px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
    transition:.3s;
}

.user-btn:hover{
    background:#0a3a73;
    transform:scale(1.05);
}

.user-dropdown{
    position:absolute;
    right:0;
    top:60px;
    width:160px;
    background:white;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
    overflow:hidden;
    display:none;
    z-index:9999;
}

.user-dropdown a{
    display:block;
    padding:14px 18px;
    color:#062b59;
    font-weight:600;
    border-bottom:1px solid #eee;
    transition:.3s;
}

.user-dropdown a:last-child{
    border-bottom:none;
}

.user-dropdown a:hover{
    background:#f4f7fa;
}

.user-dropdown.show{
    display:block;
}
</style>
</head>
<body>

  <nav class="navbar">
    <div class="container nav-inner">
      <a href="#home" class="logo">
        <img src="thelogo.png" alt="Tshwane Leadership Foundation logo">
        <span>Tshwane<br>Leadership<br>Foundation</span>
      </a>

      <button class="hamburger" id="hamburger" aria-label="Open navigation">☰</button>

      <ul class="nav-links" id="navLinks">
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#programmes">Programmes</a></li>
        <li><a href="#health-services">HTS</a></li>
        <li><a href="#get-involved">Get Involved</a></li>
        <li><a href="#feast">Feast</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#donate" class="donate-nav">Donate</a></li>
        <div class="user-menu">
   
      </ul>
    </div>
  </nav>

  <header class="hero" id="home">
    <div class="container hero-wrap">
      <div class="hero-copy">
        <div class="pill"><span></span> Pretoria-based community care since 1993</div>
        <h1>Working toward <span class="green">healthy</span> and <span class="gold">vibrant</span> communities.</h1>
        <p>
          Tshwane Leadership Foundation is an inner-city community organisation based in Pretoria,
          committed to socially inclusive urban transformation. Since 1993, TLF has supported vulnerable
          communities through programmes for women and girls, children and youth, and people experiencing homelessness.
        </p>
        <div class="hero-actions">
          <a href="#get-involved" class="btn btn-navy">Get Involved</a>
          <div class="ubuntu-sign">Ubuntu in Action</div>
        </div>
      </div>

      <div class="hero-image">
        <!-- Replace with a real image downloaded from TLF Facebook/Instagram/X -->
        <img src="homepage.jpg" alt="Tshwane Leadership Foundation community work in Pretoria">
      </div>
    </div>
  </header>

  <section class="impact-bar" id="impact">
    <div class="container">
      <div class="impact-card">
        <div class="impact-item">
          <div class="impact-icon">▣</div>
          <div><strong>1993</strong><span>Serving inner-city communities</span></div>
        </div>
        <div class="impact-item">
          <div class="impact-icon">♧</div>
          <div><strong>10</strong><span>Community projects</span></div>
        </div>
        <div class="impact-item">
          <div class="impact-icon">♧</div>
          <div><strong>3</strong><span>Key focus groups</span></div>
        </div>
      </div>
    </div>
  </section>

<section class="programmes" id="programmes">
    <div class="container">
      <div class="section-head"><div class="mini-title">TLF Programmes</div><h2>10 projects working toward healthy urban communities</h2><div class="underline"></div></div>
      <p class="programme-intro">TLF programmes work with women and girls, children and youth, homeless communities, refugees, people living with psycho-social disabilities, and vulnerable inner-city communities across Tshwane.</p>
      <div class="programme-grid">
        <article class="programme-card"><img src="gallery6.webp" alt="Women and girls programme"><div class="programme-body"><div class="circle-icon">♀</div><h3>Women and Girls</h3><p>Safe care and support through The Potter’s House and related street-based services for vulnerable women.</p></div></article>
        <article class="programme-card"><img src="gallery5.jpeg" alt="Children and youth programme"><div class="programme-body"><div class="circle-icon">⌂</div><h3>Children and Youth</h3><p>Residential, non-residential and early childhood development support through Lerato House and Inkululeko.</p></div></article>
        <article class="programme-card"><img src="gallery4.jpeg" alt="Homeless communities support programme"><div class="programme-body"><div class="circle-icon">♡</div><h3>Homeless Communities</h3><p>Outreach, drop-in support, healing, employment pathways and reintegration for people on the streets.</p></div></article>
      </div>
      <div class="programme-detail-grid">
        <article class="detail-card"><span class="status">Strategic support</span><h3>Isithebe</h3><p>Provides structural and strategic support to the Tshwane Leadership Foundation.</p><div class="phone">📞 +27 (0)12 320 2123</div></article>
        <article class="detail-card"><span class="status">Services still offered</span><h3>Akanani</h3><p>Journeys with homeless men and boys through holistic healing and integration into society through outreach, a drop-in centre and employment centre.</p><div class="phone">📞 +27 (0)12 320 2123</div></article>
        <article class="detail-card"><span class="status">Recently re-opened</span><h3>The Potter’s House</h3><p>A residential care programme for women-in-crisis and a drop-in centre supporting women on the street through holistic interventions.</p><div class="phone">📞 +27 (0)12 320 2123</div></article>
        <article class="detail-card"><span class="status">Operational</span><h3>Gilead Health Unit</h3><p>Provides transitional residential care for people living with psycho-social disabilities and vulnerable people needing palliative and geriatric care.</p><div class="phone">📞 +27 (0)12 323 6692</div></article>
        <article class="detail-card"><span class="status">Up and running</span><h3>Outreach</h3><p>Finds and befriends people who fall through the gaps of society and find themselves on the streets or in precarious housing situations.</p><div class="phone">📞 +27 (0)12 320 2123</div></article>
        <article class="detail-card"><span class="status">Training</span><h3>Institute for Urban Ministry</h3><p>Equips leaders and practitioners to reflect on their contexts and the issues of their communities through contextual courses.</p><div class="phone">📞 +27 (0)12 320 2123</div></article>
        <article class="detail-card"><span class="status">Part of Outreach</span><h3>Refugee Programme</h3><p>Provides holistic care for refugees and asylum seekers in Tshwane through a drop-in centre, outreach and document assistance.</p><div class="phone">📞 +27 (0)12 772 1125</div></article>
        <article class="detail-card"><span class="status">Non-residential</span><h3>Lerato House</h3><p>Provides care and holistic support to girl-children-at-risk and girls on the streets through drop-in support.</p><div class="phone">📞 +27 (0)12 733 8349</div></article>
        <article class="detail-card"><span class="status">Fully functional</span><h3>Inkululeko Community Centre</h3><p>An Early Childhood Development Centre focused on empowering children regarding their rights and responsibilities.</p><div class="phone">📞 +27 (0)12 321 1099</div></article>
        <article class="detail-card"><span class="status">University partnership</span><h3>Urban Studio</h3><p>Develops community-based urban praxis with Tshwane universities, helping communities build projects, capacity and skills.</p><div class="phone">📞 +27 (0)12 420 4952</div></article>
      </div>
    </div>
  </section>

  <section class="about" id="about">
    <div class="container about-grid">
      <div class="about-copy">
        <div class="mini-title">About Us</div>
        <h2>Rooted in Tshwane.<br>Built on dignity, inclusion, and <span class="green">Ubuntu.</span></h2>
        <div class="underline"></div>
        <p>
          TLF works with vulnerable inner-city communities to break cycles of poverty,
          victimhood, and exclusion. Its projects promote access, protection of rights,
          and healthier urban communities that are socially inclusive and viable.
        </p>
        <p>
          Through 10 projects, we address issues of poverty, provide access to those most in need,
          and work towards a policy environment that upholds people's rights and human dignity.
        </p>
        <a href="#contact" class="btn btn-navy">Learn More About Us</a>
      </div>

      <div class="about-image">
        <img src="tlfteam.jpg" alt="Tshwane Leadership Foundation ">
      </div>
    </div>
  </section>

  <section class="service-feature" id="health-services"><div class="container"><div class="feature-card"><img src="health.jpg" alt="HIV testing and counselling mobile services"><div><div class="mini-title" style="color:#65b82f;">Mobile Health Services</div><h2>HIV Testing and Counselling Mobile Services</h2><p>The HTS team supports communities through HIV and AIDS awareness, campaigns, education and prevention.</p><p>Services include HIV counselling and testing, TB and STI screening, defaulter tracking, family planning referrals, BP checks, blood glucose checks, weight monitoring, follow-ups and rehabilitation support.</p><p><strong>Key populations:</strong> sex workers and PWID (COSUP), supported according to the 90-90-90 strategy.</p><div class="feature-list"><span>HIV counselling and testing</span><span>TB and STI screening</span><span>BP and glucose checks</span><span>Street-medicine support</span></div><p style="margin-top:18px;"><strong>📞 +27 (0)12 323 6692</strong></p></div></div></div></section>

  <section class="gallery" id="news">
    <div class="container">
      <div class="section-head">
        <div class="mini-title">Our Impact</div>
        <h2>Building healthier and vibrant communities</h2>
        <div class="underline"></div>
      </div>

      <div class="gallery-row">
        <img src="gallery1.jpeg" alt="Community outreach activity">
        <img src="gallery2.jpeg" alt="Donation and support work">
        <img src="gallery3.jpeg" alt="Training and development programme">
        <img src="gallery4.jpeg" alt="Volunteers supporting the community">
        <img src="gallery5.jpeg" alt="Community change and awareness">
</div>

      <div class="gallery-btn">
        <a href="https://www.facebook.com/TshwaneLeadershipFoundation" class="btn-gallery" target="_blank">See More of Our Work</a>
      </div>
    </div>
  </section>

  <section class="donate-section" id="get-involved">
    <div class="container donate-grid">

      <div class="donate-box">
        <div class="mini-title">Get Involved</div>
        <h2>Volunteer, donate, or take part in our programmes.</h2>
        <p>
          Complete the form below if you would like to volunteer, donate, sponsor a project,
          or participate in one of Tshwane Leadership Foundation’s community programmes.
        </p>

        <div class="google-form-box">
          <iframe
            src="https://forms.gle/2R9YsA2d35jSaLrk7"
            width="100%"
            height="650"
            frameborder="0"
            marginheight="0"
            marginwidth="0">
            Loading…
          </iframe>
        </div>
      </div>

      <div class="bank-box" id="donate">
        <div class="mini-title">Donate Online</div>
        <h3>Make a Donation</h3>
        <p>Select a donation amount below or enter your own custom amount.</p>

        <div class="donation-buttons">
 
        </div>

        <div class="custom-donation">
          <span>R</span>
          <input type="number" id="customAmount" min="1" placeholder="Enter custom amount">
        </div>

        <a href="payment.php" class="btn btn-green">Donate</a>

        <div class="bank-details-mini">
          <h4>Bank Transfer Details</h4>
          <p><strong>Account Name:</strong><br>Tshwane Leadership Foundation</p>
          <p><strong>Bank:</strong><br>Nedbank</p>
          <p><strong>Account Number:</strong><br>1101233664</p>
          <p><strong>Branch Code:</strong><br>198765</p>
        </div>

        <p class="donation-note">
          For now, the Donate button opens an email request. To accept real online card payments,
          connect it to PayFast, Yoco, Peach Payments, or another South African payment gateway.
        </p>
      </div>

    </div>
  </section>

  <section class="festival" id="feast"><div class="container festival-card"><div class="festival-copy"><div class="mini-title">Annual City Festival</div><h2>Feast of the Clowns</h2><p>The Feast of the Clowns is an annual city festival taking place in August. Starting as a one-day festival in 2000, it is now an established seven-day festival.</p><p>It is an accessible, family-orientated festival that celebrates inner-city diversity, creates a platform for artists, raises awareness on social issues and encourages dialogue.</p><p class="big-number">20,000+ people hosted</p><p><strong>Email:</strong> feast@tlf.org.za</p></div><img src="Clowns.jpg" alt="Feast of the Clowns community festival"></div></section>

  <section class="cta"><div class="container cta-grid"><div class="cta-icon">♡</div><div><h2>Be part of the change.</h2><p>Together, we can build a city where every person lives with dignity and has the opportunity to thrive.</p></div><div class="cta-actions"><a href="#donate" class="btn btn-green">Donate Now</a><a href="https://forms.gle/2R9YsA2d35jSaLrk7"class="btn btn-outline">Volunteer With Us</a></div></div></section>

  <section class="location" id="contact-location">
    <div class="container location-grid">
      <div>
        <div class="mini-title">Visit Us</div>
        <h2>Find us in Pretoria Central</h2>
        <div class="underline"></div>
        <p>Jubilee Centre, 288 Burgers Park Lane, Pretoria Central, Tshwane, Gauteng, 0002, South Africa.</p>
      </div>
      <div class="map-card">
        <iframe
          src="https://maps.google.com/maps?q=Jubilee%20Centre%20288%20Burgers%20Park%20Lane%20Pretoria%20Central&t=&z=15&ie=UTF8&iwloc=&output=embed"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Tshwane Leadership Foundation location map">
        </iframe>
      </div>
    </div>
  </section>

  <footer class="footer" id="contact">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="footer-logo">
            <img src="thelogo.png" alt="Tshwane Leadership Foundation logo">
            <span>Tshwane<br>Leadership<br>Foundation</span>
          </div>
          <p>Working toward healthy and vibrant communities.</p>
        </div>

        <div>
          <h4>Quick Links</h4>
          <p><a href="#about">About Us</a></p>
          <p><a href="#programmes">Programmes</a></p>
          <p><a href="#health-services">Health Services</a></p>
          <p><a href="#get-involved">Get Involved</a></p>
          <p><a href="#feast">Feast of the Clowns</a></p>
          <p><a href="#contact">Contact</a></p>
        </div>

        <div>
          <h4>Connect With Us</h4>
          <div class="social-line"><span class="social-icon">f</span><p>Tshwane Leadership Foundation</p></div>
          <div class="social-line"><span class="social-icon">IG</span><p>@Tshwanelefo</p></div>
          <div class="social-line"><span class="social-icon">X</span><p>@TshwaneLF</p></div>
        </div>

        <div>
          <h4>Contact Us</h4>
          <p><strong>Address</strong><br>Jubilee Centre<br>288 Burgers Park Lane<br>Pretoria Central, Tshwane<br>Gauteng, 0002, South Africa</p>
          <p><strong>Phone</strong><br>+27 (0)12 320 2123</p>
          <p><strong>Email</strong><br>info@tlf.org.za</p>
          <p><strong>Postal Address</strong><br>P.O. Box 11047<br>Tramshed, 0126<br>South Africa</p>
        </div>
      </div>

     <div class="footer-bottom">
  © 2026 Tshwane Leadership Foundation. All rights reserved.<br>
  <span style="opacity:0.7;">
    Website designed & developed by <strong>TechUnit</strong>
  </span>
</div>
    </div>
  </footer>

  <script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const links = document.querySelectorAll('.nav-links a');
    const sections = document.querySelectorAll('header[id], section[id], footer[id]');

    hamburger.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });

    links.forEach(link => {
      link.addEventListener('click', () => navLinks.classList.remove('show'));
    });

    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 150;
        if (pageYOffset >= sectionTop) current = section.getAttribute('id');
      });

      links.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) link.classList.add('active');
      });
    });

    const amountBtns = document.querySelectorAll('.amount-btn');
    const customAmount = document.getElementById('customAmount');
    const donateBtn = document.getElementById('donateBtn');

    let selectedAmount = 500;

    function updateDonateButton(){
      donateBtn.textContent = `Donate R${selectedAmount}`;

      donateBtn.href =
        `mailto:info@tlf.org.za?subject=Donation%20of%20R${selectedAmount}&body=Hello%20Tshwane%20Leadership%20Foundation,%0D%0A%0D%0AI%20would%20like%20to%20donate%20R${selectedAmount}.%0D%0A%0D%0APlease%20send%20me%20the%20next%20steps.%0D%0A%0D%0AThank%20you.`;
    }

    amountBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        amountBtns.forEach(button => button.classList.remove('selected'));
        btn.classList.add('selected');
        selectedAmount = btn.dataset.amount;
        customAmount.value = '';
        updateDonateButton();
      });
    });

    customAmount.addEventListener('input', () => {
      if(customAmount.value && customAmount.value > 0){
        amountBtns.forEach(button => button.classList.remove('selected'));
        selectedAmount = customAmount.value;
        updateDonateButton();
      }
    });

    
updateDonateButton();

    const donateNav = document.querySelector('.donate-nav');

    if(donateNav){
      donateNav.addEventListener('mousemove', (e) => {
        const rect = donateNav.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        donateNav.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
      });

      donateNav.addEventListener('mouseleave', () => {
        donateNav.style.transform = 'translate(0,0)';
      });
    }
function toggleUserMenu() {
    document
        .getElementById("userDropdown")
        .classList
        .toggle("show");
}

window.addEventListener("click", function(e){

    const menu = document.querySelector(".user-menu");

    if(!menu.contains(e.target)){
        document
            .getElementById("userDropdown")
            .classList
            .remove("show");
    }
});
  </script>
</body>
</html>