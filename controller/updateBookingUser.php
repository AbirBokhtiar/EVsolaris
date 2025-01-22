<?php
require_once('../model/userModel.php');
require_once('../model/db.php');

$response = array('success' => false, 'error' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = intval($_POST['user_id']);
    $transaction_id = $_POST['transaction_id'];

    if (updateBookingUser($user_id, $transaction_id)) {
        $response['success'] = true;
    } else {
        $response['error'] = 'Failed to update transaction';
    }
} else {
    $response['error'] = 'Invalid request method';
}

echo json_encode($response);

?>