<?php
require_once 'db_connect.php';
require_once 'get_data.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['uid'];
$dashboard_data = get_user_dashboard_data($uid);

if (!$dashboard_data['user']) {
    header("Location: user.php");
    exit();
}

$user_data = $dashboard_data['user'];
$new_notifications = count($dashboard_data['notifications']);

$services = [
    ['name' => 'Referrals', 'image' => 'img/users-icon.png', 'link' => 'referrals.php'],
    ['name' => 'Wallet', 'image' => 'img/money.png', 'link' => 'wallet.php'],
    ['name' => 'Games', 'image' => 'img/game.png', 'link' => 'game.php'],
    ['name' => 'Faucet', 'image' => 'img/faucet.png', 'link' => 'faucet.php'],
    ['name' => 'PTC', 'image' => 'img/click.png', 'link' => 'ptc.php'],
    ['name' => 'Videos', 'link' => 'video.php', 'image' => 'img/support.png']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        #ads {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 250px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-lg shadow mr-4 ml-4 mt-4 p-4 flex justify-between items-center">
        <div class="flex items-center space-x-10">
            <img src="<?php echo htmlspecialchars($user_data['photo']); ?>" alt="Profile" class="bg-white w-12 h-12 rounded-full">
            <div>
                <h1 class="text-lg font-semibold -pb-5">Hi, <?php echo htmlspecialchars($user_data['username']); ?></h1>
                <p class="text-sm -pb-5">Welcome Back 🎉</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-5">
            <a href="spins.php" class="relative">
                <i class="fas fa-ticket-alt text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"><?php echo $user_data['available_tickets']; ?></span>
            </a>
            <a href="notifications.php" class="relative">
                <i class="fas fa-bell text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"><?php echo $new_notifications; ?></span>
            </a>
        </div>
    </header>

    <main class="flex-grow p-4 space-y-6">
        <div class="flex-grid bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium">Available Balance</span>
                <h2 class="text-2xl font-bold">₦<?php echo number_format($user_data['available_balance'], 2); ?></h2>
            </div>
            <hr class="font-bold">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium">Total Withdrawn</span>
                <h2 class="text-2xl font-bold">₦<?php echo number_format($user_data['total_withdrawn'], 2); ?></h2>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="grid grid-cols-3 gap-4">
                <?php foreach ($services as $service): ?>
                    <a href="<?php echo $service['link']; ?>" class="flex flex-col items-center p-2 bg-gray-100 rounded-lg">
                        <img src="<?php echo $service['image']; ?>" alt="<?php echo $service['name']; ?>" class="w-10 h-10">
                        <span class="text-sm"><?php echo $service['name']; ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div id="ads" class="h-150 -z-index-2">
            <script async="async" data-cfasync="false" src="//pl24616866.profitablecpmrate.com/a2a9dd53c2d231f3b9ade9f8448cdfa3/invoke.js"></script>
            <div id="container-a2a9dd53c2d231f3b9ade9f8448cdfa3"></div>
        </div>
    </main>

    <!-- Floating WhatsApp Button -->
    <div class="floating-button">
        <a href="https://wa.me/YOUR_WHATSAPP_NUMBER" target="_blank">
            <img src="img/whatsapp-icon.png" alt="Customer Care">
        </a>
    </div>

    <nav class="bg-white border-t sticky bottom-0">
        <ul class="flex justify-around p-5 g-2">
            <li><a href="dashboard.php" class="flex flex-col items-center text-purple-600"><i class="fas fa-home"></i><span class="text-xs">Dashboard</span></a></li>
            <li><a href="referrals.php" class="flex flex-col items-center text-gray-600"><i class="fas fa-users"></i><span class="text-xs">Referrals</span></a></li>
            <li><a href="reward.php" class="flex flex-col items-center text-gray-600"><i class="fas fa-gift"></i><span class="text-xs">Reward</span></a></li>
            <li><a href="transactions.php" class="flex flex-col items-center text-gray-600"><i class="fas fa-exchange-alt"></i><span class="text-xs">Transactions</span></a></li>
            <li><a href="profile.php" class="flex flex-col items-center text-gray-600"><i class="fas fa-user"></i><span class="text-xs">Profile</span></a></li>
        </ul>
    </nav>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
    <script src="dash.js"></script>
</body>
</html>