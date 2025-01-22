<?php
    session_start();
    

    require_once('../model/userModel.php');
    // require_once('../model/db.php');
    
    $user_id = $_SESSION['userId'];
    $username = htmlspecialchars(getUsernameById($user_id));
    $subscription = htmlspecialchars(getSubscriptionById($user_id));

    $getAllTransacs = getTransactionAllById($user_id);
    $transactions = array_reverse(array_slice(getTransactionByUser($user_id), -2));
    // foreach ($usr as $arr){
    //     foreach ($arr as $key => $value){
    //         echo $key ." ".$value;
    //     }
    // }
    $totalCompletedAmount = 0;
    foreach ($getAllTransacs as $transaction) {
        if ($transaction['status'] === 'Done') {
            $totalCompletedAmount += $transaction['amount'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            margin-left: 30%;
        }
        .profile img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .transaction {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .transaction h4 {
            margin: 0;
        }
        .button {
            background-color: #227c78;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 40%;
        }
        .button:hover {
            background-color: #24504d;
        }
        .link {
            color: #007bff;
            cursor: pointer;
        }
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
    </style>
</head>
<body>
<a href="user.php">home</a>
<div class="container">
    <div class="profile" id="profile">
        <img src="https://media.licdn.com/dms/image/v2/D5603AQHSu24yce-gMQ/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1714155631314?e=1741219200&v=beta&t=sO6eWlaMUSyThgjMF6GvOjnr4M7RIhXj3gg__52CkvI" alt="Profile Photo">
        <div>
            <h3>Username: <?php echo $username; ?></h3>
            <p>Total Amount of Transactions: <?php echo $totalCompletedAmount; ?></p>
        </div>
    </div>

    <!-- <button class="button">Subscriptions</button> -->
    <button class="button" onclick="showPopup('subscriptionPopup')">Subscriptions</button>

    <h2>Recent Transactions</h2>

    <!-- <div class="popup" id="detailsPopup"> -->
        <!-- <div id="popup1"> -->
        <?php
        
        foreach ($transactions as $index => $transaction) {
            $popupId = 'detailsPopup' . $index;
            echo '<div class="transaction">';
            echo '<h4>Transaction ID: ' . $transaction['transaction_id'] . '</h4>';
            echo '<p>Amount: $' . $transaction['amount'] . '</p>';
            echo '<p>Date: ' . $transaction['date'] . '</p>';
            echo '<p>Status: <span style="color: ' . ($transaction['status'] == 'Done' ? 'green' : 'orange') . ';">' . $transaction['status'] . '</span></p>';
            echo '<span class="link" onclick="showPopup(\'' . $popupId . '\')">More Details</span>';
            echo '</div>';
            echo '<div class="popup" id="' . $popupId . '">';
            echo '<div class="popup-content">';
            echo '<h4>Transaction Details</h4>';
            echo '<p>Transaction ID: ' . $transaction['transaction_id'] . '</p>';
            echo '<p>Amount: $' . $transaction['amount'] . '</p>';
            echo '<p>Date: ' . $transaction['date'] . '</p>';
            echo '<p>Status: ' . $transaction['status'] . '</p>';
            echo '<button class="button" onclick="closePopup(\'' . $popupId . '\')">Close</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    <!-- </div> -->

    <!-- <div class="transaction">
        <h4>Transaction ID: TX123456</h4>
        <p>Amount: $200</p>
        <p>Date: 2025-01-01</p>
        <p>Status: <span style="color: green;">Confirmed</span></p>
        <span class="link">More Details</span>
        <span class="link" onclick="showPopup('detailsPopup')">More Details</span>
    </div> -->

    <a href="transaction_history.php">Transactions History</a>
</div>

<!-- Transaction Details Popup -->
<div class="popup" id="detailsPopup1">
    <div class="popup-content">
        <h4>Transaction Details</h4>
        <p>Transaction id: <?php echo $transaction['transaction_id'] ?></p>
        <p>Amount : $ <?php echo $transaction['amount'] ?></p>
        <p>Date: <?php echo $transaction['date'] ?></p>
        <p>Status: <?php echo $transaction['status'] ?></p>
        <button class="button" onclick="closePopup('detailsPopup1')">Close</button>
    </div>
</div>

<!-- Subscription Popup -->
<div class="popup" id="subscriptionPopup">
    <div class="popup-content">
        <h4>Current Subscription Details</h4>
        <p>Subscription Plan: <?php echo $subscription; ?></p>
        <p>Renewal Date: 2025-12-31</p>
        <!-- <button class="button">Close</button> -->
        <button class="button" onclick="closePopup('subscriptionPopup')">Close</button>
    </div>
</div>

<!-- Transaction Details Popup -->
<!-- <div class="popup" id="detailsPopup">
    <div class="popup-content">
        <h4>Transaction Details</h4>
        <p>Transaction ID: TX123456</p>
        <p>Amount: $200</p>
        <p>Date: 2025-01-01</p>
        <p>Status: Confirmed</p>
        <button class="button">Close</button>
        <button class="button" onclick="closePopup('detailsPopup')">Close</button>
    </div>
</div> -->

<script>
    function showPopup(popupId) {
        document.getElementById(popupId).style.display = 'flex';
    }

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }
</script>

</body>
</html>

