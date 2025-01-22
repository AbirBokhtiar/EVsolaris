<?php
require_once('../model/userModel.php');
require_once('../model/db.php');

$response = array('success' => false, 'error' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $transaction_id = $_POST['transaction_id'];
    $amount = floatval($_POST['amount']);
    $city = $_POST['city'];
    $date = $_POST['date'];
    error_log('Date received: ' . $date);
    $status = $_POST['status'];
    $station_company = $_POST['station_company'];

    if (createBookingUser($user_id, $transaction_id, $amount, $city, $date, $status, $station_company)) {
        $_SESSION['transaction_id'] = $transaction_id;
        // echo $_SESSION['transaction_id'];
        $response['success'] = true;
    } else {
        $response['error'] = 'Failed to create transaction';
    }
} else {
    $response['error'] = 'Invalid request method';
}

echo json_encode($response);
?>