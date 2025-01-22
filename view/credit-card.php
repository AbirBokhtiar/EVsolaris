<?php
session_start();
if (!isset($_COOKIE['status'])) {
    header('location: login.html');
}

require_once('../model/userModel.php');
$user_id = $_SESSION['user_id'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        .payment-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .payment-form h2 {
            margin-bottom: 20px;
            font-size: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .input-group .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .checkbox-group {
            margin-bottom: 15px;
        }

        .checkbox-group input {
            margin-right: 10px;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: #333;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 15px;
            font-size: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .buttons .check-booking {
            background-color: #ffffff;
            color: #227c78;
            border: 1px solid #227c78;
            font-weight: 550;
        }

        .buttons .complete-booking {
            background-color: #227c78;
            color: white;
            font-weight: 550;
        }

        .buttons button:hover {
            opacity: 0.8;
        }

        .info {
            margin-top: 20px;
            font-size: 0.875rem;
            color: #555;
        }

        .info a {
            color: #007bff;
            text-decoration: none;
        }

        .info a:hover {
            text-decoration: underline;
        }

        .credit-cards {
            display: flex;
            margin-bottom: 20px;
        }
    </style>

    <script src='../asset/credit_script.js'></script>

</head>
<body>
    <form id="payment-form" class="payment-form" method="post">
        <h2>How would you like to pay?</h2>

        <div class="credit-cards">
            <img src="https://img.icons8.com/color/48/000000/visa.png" alt="visa">
            <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="mastercard">
            <img src="https://img.icons8.com/color/48/000000/amex.png" alt="amex">
            <img src="https://img.icons8.com/color/48/000000/discover.png" alt="discover">
        </div>

        <div class="input-group">
            <label for="cardholder_name">Cardholder's Name *</label>
            <input type="text" id="cardholder_name" name="cardholder_name" placeholder="Enter cardholder's name" required>
            
            <span class="error" id="err_cardholderName"></span>
        
            <label for="card_number">Card Number *</label>
            <input type="text" id="card_number" name="card_number" placeholder="Enter card number" required>
            
            <span class="error" id="err_cardnumber"></span>
        
            <label for="cvv">CVV *</label>
            <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
            
            <span class="error" id="err_cvv"></span>
        
            <label for="expiry_date">Expiry Date *</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM / YY" required>
            
            <span class="error" id="err_expdate"></span>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="marketing-consent" checked>
            <label for="marketing-consent">I consent to receiving marketing emails from EVstation.com, including promotions, personalized recommendations, and more.</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="secondary-consent">
            <label for="secondary-consent">I consent to receiving marketing emails about EVstation.com Transport Limited's products and services.</label>
        </div>

        <div class="info">
            By signing up, you let us tailor offers and content to your interests. Read our 
            <a href="PrivacyPolicy.html">privacy policy</a>.
        </div>

        <div class="info">
            Read the 
            <a href="#">booking conditions</a>, 
            <a href="Terms_and_conditions.html">general terms</a>, 
            <a href="PrivacyPolicy.html">privacy policy</a>, and 
            <a href="#">wallet terms</a>.
        </div>

        <input type="hidden" name="user_id" id= "user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="transaction_id" id="transaction_id" value="<?php echo $transaction_id; ?>">
        
        <div class="buttons">
            <button class="check-booking">Check your booking</button>
            <button type="submit" name="submit" class="complete-booking" id="completeBooking">Complete booking</button>
        </div>
    </form>
</body>
</html>