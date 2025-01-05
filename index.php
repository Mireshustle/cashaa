<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casha | Paid To Play</title>
    <link rel="stylesheet" href="css/styles.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app.js" type="module"></script>
<script src="scripts/auth-google.js" type="module"></script> />

</head>

<body>

    <!-- Web Logo -->
    <header class="logo-header">
        <img src="img/logo.png" alt="Web Logo" class="web-logo">
    </header>

      <!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <img src="customer-service.png" class="img">
    <br>
    <h1 class="slide-h">PLAY GAMES</h1> 
  </div>

  <div class="mySlides fade">
    <img src="support.png" class="img">
    <br>
    <h1 class="slide-h">REFER A FRIEND</h1>
  </div>

  <div class="mySlides fade">
    <img src="uba.png" class="img">
     <br>
     <h1 class="slide-h">INSTANT CASHOUT</h1>
  </div>
    <div class="mySlides fade">
    <img src="support.png" class="img">
    <br>
     <h1 class="slide-h">24 HOURS SUPPORT</h1> 
    </div>
</div>

    <!-- Info Section -->
    <section class="info-section">
        <!-- Bank Information Card -->
        <div class="info-card">
            <img src="img/bank-icon.png" alt="Bank Withdrawal" class="bank-icon">
            <h2 class="bank-info-h">Automatic Local Bank Withdrawals</h2>
            <p class="bank-info-p">Withdraw earnings directly to your local bank account with ease.</p>

            <!-- Supported Banks Grid -->
            <div class="bank-grid">
                <img src="img/bank1.png" alt="Bank 1">
                <img src="img/bank2.png" alt="Bank 2">
                <img src="img/bank3.jpeg" alt="Bank 3">
                <img src="img/bank4.jpeg" alt="Bank 4">
                <img src="img/bank5.png" alt="Bank 5">
                <img src="img/bank6.jpg" alt="Bank 6">
                <img src="img/bank7.jpg" alt="Bank 7">
                <img src="img/bank8.png" alt="Bank 8">
            </div>
            <!-- Google Login Button -->
            <div class="auth-buttons">
                <button id="loginButton" class="google-auth-btn">
                    <img src="img/google-icon.png" alt="Google Login"> Login with Google
                </button>
            </div>
            <!-- Total Users Statistics Card -->
            <div class="info-card stat">
                <img src="img/users-icon.png" alt="Total Users" class="icon">
                <h2>Total Users</h2>
                <p><span id="totalUsers">Loading...</span> users currently on the platform</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h1>Features</h1>
        <div class="feature-card">
            <img src="img/faucet.png" alt="Faucet">
            <h3>Faucet</h3>
            <p>Claim every hour</p>
        </div>
        <div class="feature-card">
            <img src="img/click.png" alt="Paid to Click">
            <h3>Paid to Click</h3>
            <p>Earn by clicking URLs</p>
        </div>
        <div class="feature-card">
            <img src="img/game.png" alt="Drop Game">
            <h3>Drop Game</h3>
            <p>Play and earn points for withdrawal</p>
        </div>
        <div class="feature-card">
            <img src="img/bonus.png" alt="Daily Bonus">
            <h3>Daily Bonus</h3>
            <p>Login bonus and daily redeemable coupon</p>
        </div>
    </section>


    <!-- faq Section -->
    <section id="faq">
        <div class="faq-img">
            <img src="img/faq.png" alt="Faucet">
        </div>


        <div class="faq-card">
            <div class="faq-question">
                <p>What is personal banking?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>Personal banking refers to financial services offered by banks to individuals for their personal needs, such as saving, borrowing, and investing.</p>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">
                <p>What documents do I need to open a Moniepoint Personal Bank account?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>To open a Moniepoint Personal Bank account, you typically need to provide valid identification documents, such as a national ID card, driver's license, or passport.</p>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">
                <p>Is there a fee for opening an account?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>Some banks may charge a fee for opening a bank account. However, many banks offer free account opening.</p>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">
                <p>Is Moniepoint safe?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>Moniepoint is a regulated financial institution, and your funds are insured. They have robust security measures in place to protect your account information and funds.</p>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">
                <p>Can a personal bank account be used for business?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>It's generally not recommended to use a personal bank account for business purposes. Business activities can complicate your personal finances and may not be fully covered by personal banking protections.</p>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">
                <p>How many personal bank accounts can I have?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>You can typically have multiple personal bank accounts with the same bank or different banks. However, there may be limits on the number of accounts you can open.</p>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">
                <p>How do I access my account?</p>
                <span class="arrow-down"></span>
            </div>
            <div class="faq-answer">
                <p>You can access your account through various channels, including online banking, mobile banking, and in-person at a bank branch.</p>
            </div>
        </div>
    </section>


    <!-- Floating WhatsApp Button -->
    <div class="floating-button">
        <a href="https://wa.me/YOUR_WHATSAPP_NUMBER" target="_blank">
            <img src="img/whatsapp-icon.png" alt="Customer Care">
        </a>
    </div>

    <!-- footer section -->
    <footer>
        <div class="footer-links">
            <div class="footer-grid">
                <div class="social">
                    <h3>Social</h3>
                    <ul>
                        <li><a href="https://facebook.com/YOUR_FACEBOOK_GROUP" target="_blank">Facebook Group</a></li>
                        <li><a href="https://wa.me/YOUR_WHATSAPP_CHANNEL" target="_blank">WhatsApp Channel</a></li>
                    </ul>
                </div>
                <div class="legal">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="contact">
                <h3>Contact</h3>
                <ul>
                    <li><a href="#">Customer Care</a></li>
                </ul>
            </div>
            <hr>
            <div class="footer-copyright">
                &copy; 2024 Casha. All rights reserved.
            </div>
        </div>
    </footer>



    <script src="scripts/app.js"></script>
    <script src="scripts/auth-google.js" type="module"></script>
</body>

</html>