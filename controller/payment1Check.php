<?php
session_start();

$email = $phone = $name = $address = $paymentMethod = "";
$emailErr = $phoneErr = $nameErr = $addressErr = $paymentMethodErr = "";

$response = array('success' => false, 'errors' => array());

if (isset($_POST['submit'])) {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } 
    else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } 
    else {
        $phone = test_input($_POST["phone"]);
        $phone_array = explode("-", $phone);
        if (count($phone_array) != 2 || $phone_array[0] != "+880" || strlen($phone_array[1]) != 10 || !ctype_digit($phone_array[1])) {
            $phoneErr = "Invalid phone number format";
        }
    }

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } 
    else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } 
    else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["payment-method"])) {
        $paymentMethodErr = "Payment method is required";
    } 
    else {
        $paymentMethod = test_input($_POST["payment-method"]);
    }

    if (empty($emailErr) && empty($phoneErr) && empty($nameErr) && empty($addressErr) && empty($paymentMethodErr)) {
        
        $response['success'] = true;
        $response['total_cost'] = $_SESSION['payment_info']['total_cost'];
        $response['payment_method'] = $paymentMethod;
        $response['booking_details'] = $_SESSION['payment_info']['station_name'] . ', ' . $_SESSION['payment_info']['slot_time'];
        
    } 
    else {
        // $_SESSION['emailErr'] = $emailErr;
        // $_SESSION['phoneErr'] = $phoneErr;
        // $_SESSION['nameErr'] = $nameErr;
        // $_SESSION['addressErr'] = $addressErr;
        // $_SESSION['paymentMethodErr'] = $paymentMethodErr;
        // header('location: ../view/payment1.php');
        // exit();

        $response['errors'] = array(
            'emailErr' => $emailErr,
            'phoneErr' => $phoneErr,
            'nameErr' => $nameErr,
            'addressErr' => $addressErr,
            'paymentMethodErr' => $paymentMethodErr
        );
    }
    
} else {
    $response['errors'] = array('submit' => 'Form not submitted correctly');
}


// else {
//     header('location: ../view/credit-card.php');
//     exit();
// }

echo json_encode($response);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>