<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['idToken'])) {
    echo json_encode(['success' => false, 'message' => 'Token not provided.']);
    exit;
}

$idToken = $data['idToken'];

try {
    // Initialize Firebase
    $factory = (new Factory)->withServiceAccount(__DIR__ . '/vendor/scp/serviceAccountKey.json');
    $auth = $factory->createAuth();

    // Verify the ID token
    $verifiedIdToken = $auth->verifyIdToken($idToken);
    $uid = $verifiedIdToken->claims()->get('sub');

    // Save user session
    $_SESSION['uid'] = $uid;

    // Respond with success
    echo json_encode(['success' => true]);
} catch (FailedToVerifyToken $e) {
    echo json_encode(['success' => false, 'message' => 'Invalid token: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}
?>