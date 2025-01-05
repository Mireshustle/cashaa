<?php
session_start();
require_once 'db_connect.php';
require_once 'get_data.php';

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['uid'];
$user = get_user_by_uid($uid);

if (!$user) {
    header("Location: user.php");
    exit();
}
?>


<main class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-purple-600 text-white p-4">
                <h1 class="text-2xl font-bold text-center">User Profile</h1>
            </div>
            
            <div class="p-4">
                <div class="flex justify-center mb-6">
                    <?php if (!empty($user['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Photo" class="w-32 h-32 rounded-full object-cover border-4 border-purple-600">
                    <?php else: ?>
                        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center text-gray-500">
                            <span class="text-4xl">?</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm text-center text-gray-600">Username</p>
                        <p class="font-semibold text-center"><?php echo htmlspecialchars($user['username']); ?></p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm text-center text-gray-600">Email</p>
                        <p class="font-semibold text-center"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm text-center text-gray-600">Phone</p>
                        <p class="font-semibold text-center"><?php echo htmlspecialchars($user['phone']); ?></p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm text-center text-gray-600">Bank Name</p>
                        <p class="font-semibold text-center"><?php echo htmlspecialchars($user['bank_name']); ?></p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm text-center text-gray-600">Account Number</p>
                        <p class="font-semibold text-center"><?php echo htmlspecialchars($user['account_number']); ?></p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded">
                        <p class="text-sm text-center text-gray-600">Account Holder's Name</p>
                        <p class="font-semibold text-center"><?php echo htmlspecialchars($user['account_name']); ?></p>
                    </div>
                </div>

               <div class="mt-8 space-y-4 flex flex-col items-center">
    <a href="account.php" class="flex justify-center text-purple-600 text-center">
        Update Your Profile
    </a>
    <a href="logout.php" class="w-1/2 bg-red-600 text-white flex justify-center items-center py-2 px-4 rounded hover:bg-red-700 transition duration-300">
        Logout
    </a>
</div>
            </div>
        </div>
    </div>
</main>
