<?php
session_start();
if (!isset($_COOKIE['status'])) {
    header('location: login.html');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['payment_info'] = array(
        'station_name' => htmlspecialchars($_POST['station_name']),
        'station_address' => htmlspecialchars($_POST['station_address']),
        'station_price' => floatval($_POST['station_price']),
        'station_city' => htmlspecialchars($_POST['station_city']),
        'slot_time' => htmlspecialchars($_POST['slot']),
        'tax' => floatval($_POST['station_price']) * 0.10,
        'discount' => floatval($_POST['station_price']) * 0.05,
        'total_cost' => floatval($_POST['station_price']) + (floatval($_POST['station_price']) * 0.10) - (floatval($_POST['station_price']) * 0.05)
    );
}

require_once('../model/userModel.php');
$user_id = $_SESSION['user_id'];
$username = htmlspecialchars(getUsernameById($user_id));

$userbookings = getBookingsByUser($user_id);
// $station_name =$station['st_name'];
// foreach ($userbookings as $booking) {
//     $station_name = htmlspecialchars($booking['st_name']);
//     $station_slot = htmlspecialchars($booking['st_slot']);
//     $station_price = htmlspecialchars($booking['st_price']);
//     // $total = htmlspecialchars($booking['total']);
// }

$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : '';
$phoneErr = isset($_SESSION['phoneErr']) ? $_SESSION['phoneErr'] : '';
$nameErr = isset($_SESSION['nameErr']) ? $_SESSION['nameErr'] : '';
$addressErr = isset($_SESSION['addressErr']) ? $_SESSION['addressErr'] : '';
$paymentMethodErr = isset($_SESSION['paymentMethodErr']) ? $_SESSION['paymentMethodErr'] : '';

unset($_SESSION['emailErr']);
unset($_SESSION['phoneErr']);
unset($_SESSION['nameErr']);
unset($_SESSION['addressErr']);
unset($_SESSION['paymentMethodErr']);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
        }

        h2 {
            color: #227c78;
            margin-bottom: 10px;
        }

        #user-profile div {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #user-profile img {
            /* border-radius: 50%; */
            border: 2px solid #227c78;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin: 5px 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 80%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        fieldset {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        fieldset .form-group {
            margin: 20px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #227c78;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #24504d;
        }

        #payment-confirmation {
            display: none;
        }

        #payment-confirmation div {
            margin-top: 10px;
        }
        .error{
            color: red;
        }
    </style>
    
    <script src="../asset/script.js"></script>

</head>
<body>
    <section id="user-profile">
        <h2>User Profile</h2>
        <div>
            <p>Username: <span id="username"><?php echo $username; ?></span></p>
            <img id="profile-picture" src="https://media.licdn.com/dms/image/v2/D5603AQHSu24yce-gMQ/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1714155631314?e=1741219200&v=beta&t=sO6eWlaMUSyThgjMF6GvOjnr4M7RIhXj3gg__52CkvI" alt="Profile Picture" width="100">
        </div>
    </section>

    <section id="booking-details">
        <h2>Booking Details</h2>
        <div>
            <p>Station Name: <span id="station-name"><?php echo $_SESSION['payment_info']['station_name']; ?></span></p>
            <p>Station Address: <span id="station-address"><?php echo $_SESSION['payment_info']['station_address']; ?></span></p>
            <p>Slot Time: <span id="slot-time"><?php echo $_SESSION['payment_info']['slot_time']; ?></span></p>
            <p>Pricing Details:</p>
            <ul>
                <li>Base Cost: <?php echo $_SESSION['payment_info']['station_price']; ?></li>
                <li>Taxes (10%): <?php echo $_SESSION['payment_info']['tax']; ?></li>
                <li>Discounts (5%): <?php echo $_SESSION['payment_info']['discount']; ?></li>
            </ul>
            <p><strong>Total Cost: <?php echo $_SESSION['payment_info']['total_cost']; ?></strong></p>
        </div>
    </section>


    <!-- Payment Form Section -->
    <section>
        <h2>Payment Form</h2>
        <form id="payment-form" method="POST" >
            <fieldset>
                <legend>User Details</legend>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="example@example.com" required>
                    <span class="error" id="emailErr"><?php echo $emailErr;?></span>
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="+880-1234567890" required>
                    <span class="error" id="phoneErr"><?php echo $phoneErr;?></span>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <span class="error" id="nameErr"><?php echo $nameErr;?></span>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Your Address" required>
                    <span class="error" id="addressErr"><?php echo $addressErr;?></span>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group">
                    <legend>Choose One Payment Method</legend>
                    <label><input type="radio" name="payment-method" value="Credit/Debit card" required> Credit/Debit Card</label>
                    <label><input type="radio" name="payment-method" value="online" required> Online Payment Gateway</label>
                    <span class="error" id="paymentMethodErr"><?php echo $paymentMethodErr;?></span>
                </div>
            </fieldset>

            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

    <!-- Add this hidden input field for user_id -->
    <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" id="station_name" value="<?php echo $_SESSION['payment_info']['station_name']; ?>">
    <input type="hidden" id="station_city" value="<?php echo $_SESSION['payment_info']['station_city']; ?>">
    <script>
    console.log('Hidden input field value for city:', document.getElementById('station_city').value);
    </script>


    <!-- Payment Confirmation Section -->
    <section id="payment-confirmation">
        <h2>Payment Confirmation</h2>
        <div>
            <p>Amount: <span id="payment-amount"><?php echo $_SESSION['payment_info']['total_cost'] ?></span></p>
            <p>Selected Method: <span id="selected-method"><?php echo isset($_POST['payment-method']) ? htmlspecialchars($_POST['payment-method']) : 'Not selected'; ?></span></p>
            <p>Booking Details: <span id="payment-booking-details"> <?php echo $_SESSION['payment_info']['station_name'] . ', ' . $_SESSION['payment_info']['slot_time']; ?> </span></p>
            <button id="proceed-to-pay"><a href="credit-card.php" style= "text-decoration: none; color: white;">Proceed to Pay</a></button>
    </section>

</body>
</html>