<?php
session_start();
// $errors = [];
require_once('../model/userModel.php');
require_once('../model/db.php');
$response = array('success' => false, 'errors' => array());

if (isset($_POST['submit'])) {

    $cardholder_name = trim($_POST['cardholder_name']);
    $card_number = trim($_POST['card_number']);
    $cvv = trim($_POST['cvv']);
    $expiry_date = trim($_POST['expiry_date']);

    // Validate Cardholder's Name
    if (empty($cardholder_name)) {
        // $errors['cardholder_name'] = "Please enter the cardholder's name.";
        $err_cardholderName = "Please enter the cardholder's name.";
    }

    // Card Number
    if (empty($card_number) || strlen($card_number) !== 16 || !ctype_digit($card_number)) {
        // $errors['card_number'] = "Please enter a valid 16-digit card number.";
        $err_cardnumber = "Please enter a valid 16-digit card number.";
    }

    //CVV
    if (empty($cvv) || strlen($cvv) !== 3 || !ctype_digit($cvv)) {
        // $errors['cvv'] = "Please enter a valid 3-digit CVV.";
        $err_cvv = "Please enter a valid 3-digit CVV.";
    }

    //Expiry Date
    if (empty($expiry_date)) {
        // $errors['expiry_date'] = "Please enter a valid expiry date in MM/YY format.";
        $err_expdate = "Please enter a valid expiry date in MM/YY format.";
    } else {
        $expiry_date_array = explode('/', $expiry_date);
        if (count($expiry_date_array) !== 2 || (int)$expiry_date_array[0] < 1 || (int)$expiry_date_array[0] > 12 || (int)$expiry_date_array[1] < 0 || (int)$expiry_date_array[1] > 99) {
            $err_expdate = "Please enter a valid expiry date in MM/YY format.";
        }
    }

    if (empty($err_cardholderName) && empty($err_cardnumber) && empty($err_cvv) && empty($err_expdate)) {
        
        $response['success'] = true;
        $response['cardholder_name'] = $cardholder_name;
        $response['card_number'] = $card_number;
        $response['cvv'] = $cvv;
        $response['expiry_date'] = $expiry_date;
        
    }
    else{
        $response['errors'] = array(
            'err_cardholderName' => $err_cardholderName,
            'err_cardnumber' => $err_cardnumber,
            'err_cvv' => $err_cvv,
            'err_expdate' => $err_expdate,
        );
    }

} else {
    $response['errors'] = array('submit' => 'Form not submitted correctly');
}

echo json_encode($response);

?>