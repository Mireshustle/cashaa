<?php
session_start();
require_once 'db_connect.php';
require_once 'get_data.php';
require_once 'post_data.php';

// Check if UID is set in session
if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['uid'];
$user = get_user_by_uid($uid);

if (!$user) {
    // User doesn't exist, redirect to user.php for initial registration
    header("Location: user.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $bank_name = trim($_POST['bank_name']);
    $account_number = trim($_POST['account_number']);
    $account_name = trim($_POST['account_name']);
    $withdrawal_pin = trim($_POST['withdrawal_pin']);

    // Validate input
    if (empty($username) || empty($phone) || empty($email) || empty($bank_name) || empty($account_number) || empty($account_name)) {
        $error = "All fields except Withdrawal PIN are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strpos($email, '@gmail.com') === false) {
        $error = "Please use a Gmail address.";
    } elseif (!empty($withdrawal_pin) && (strlen($withdrawal_pin) !== 4 || !ctype_digit($withdrawal_pin))) {
        $error = "Withdrawal PIN must be a 4-digit number.";
    } else {
        // Check if username already exists (excluding the current user)
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? AND uid != ?");
        $stmt->execute([$username, $uid]);
        if ($stmt->fetch()) {
            $error = "Username already exists. Please choose a different one.";
        } else {
            // Handle file upload
            $photo_path = $user['photo']; // Keep existing photo if no new one is uploaded
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $allowed = ["jpg", "jpeg", "png", "gif"];
                $filename = $_FILES["photo"]["name"];
                $filetype = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array(strtolower($filetype), $allowed)) {
                    $new_filename = uniqid() . "." . $filetype;
                    $upload_path = "uploads/" . $new_filename;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $upload_path)) {
                        $photo_path = $upload_path;
                    } else {
                        $error = "Failed to upload the photo. Error: " . error_get_last()['message'];
                    }
                } else {
                    $error = "Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.";
                }
            }

            if (empty($error)) {
                // All checks passed, update user
                $update_data = [
                    'username' => $username,
                    'email' => $email,
                    'phone' => $phone,
                    'bank_name' => $bank_name,
                    'account_number' => $account_number,
                    'account_name' => $account_name,
                    'photo' => $photo_path,
                    'uid' => $uid
                ];

                if (!empty($withdrawal_pin)) {
                    $update_data['withdrawal_pin'] = password_hash($withdrawal_pin, PASSWORD_DEFAULT);
                }

                $sql = "UPDATE users SET username = :username, email = :email, phone = :phone, 
                        bank_name = :bank_name, account_number = :account_number, account_name = :account_name, 
                        photo = :photo";
                
                if (!empty($withdrawal_pin)) {
                    $sql .= ", withdrawal_pin = :withdrawal_pin";
                }
                
                $sql .= " WHERE uid = :uid";

                $stmt = $pdo->prepare($sql);
                try {
                    if ($stmt->execute($update_data)) {
                        $success = "Account updated successfully! Redirecting to dashboard...";
                        header("Refresh: 3; URL=dashboard.php");
                    } else {
                        $error = "An error occurred while updating data. Please try again.";
                    }
                } catch (PDOException $e) {
                    $error = "Database error: " . $e->getMessage();
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; }
        h1 { text-align: center; }
        form { background: #f4f4f4; padding: 20px; border-radius: 5px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"], input[type="file"] { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 3px; }
        input[type="submit"] { display: flex; width: 50%; margin:auto; justify-content: center; padding: 10px; background: #333; color: #fff; border: none; border-radius: 10px; cursor: pointer; }
        input[type="submit"]:hover { background: #555; }
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
        .current-photo { text-align: center; margin-bottom: 10px; }
        .current-photo img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Your Account</h1>
        <?php
        if ($error) {
            echo "<p class='error'>$error</p>";
        }
        if ($success) {
            echo "<p class='success'>$success</p>";
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="current-photo">
                <?php if (!empty($user['photo'])): ?>
                    <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Current profile photo">
                <?php else: ?>
                    <p>No profile photo uploaded</p>
                <?php endif; ?>
            </div>

            <label for="photo">Update Profile Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>

            <label for="email">Email (Gmail only):</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="bank_name">Bank Name:</label>
            <input type="text" id="bank_name" name="bank_name" value="<?php echo htmlspecialchars($user['bank_name']); ?>" required>

            <label for="account_number">Account Number:</label>
            <input type="text" id="account_number" name="account_number" value="<?php echo htmlspecialchars($user['account_number']); ?>" required>

            <label for="account_name">Account Holder's Name:</label>
            <input type="text" id="account_name" name="account_name" value="<?php echo htmlspecialchars($user['account_name']); ?>" required>

            <label for="withdrawal_pin">New Withdrawal PIN (4 digits, leave blank to keep current):</label>
            <input type="password" id="withdrawal_pin" name="withdrawal_pin" minlength="4" maxlength="4" pattern="\d{4}">

            <input type="submit" value="Update Account">
        </form>
    </div>
</body>
</html>