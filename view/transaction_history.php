
<?php
    // session_start();
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');
    // }

    require_once('../model/userModel.php');
    require_once('../model/db.php');

    $user_id = $_SESSION['userId'];
    $usertransactions = getTransactionByUser($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        /* Header Navigation */
        header {
            background-color: #227c78;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* Dashboard Statistics */
        .stats {
            display: flex;
            justify-content: space-evenly;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            border-radius: 8px;
            max-width: 1000px;
        }

        .stats .card {
            text-align: center;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            flex: 1;
            margin: 0 10px;
        }

        .stats .card h2 {
            margin: 0;
            font-size: 36px;
            color: #007bff;
        }

        .stats .card p {
            margin: 5px 0;
        }

        /* Search Bar and Filters */
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            max-width: 1000px;
            padding: 10px;
        }

        .controls input {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .controls button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            max-width: 1000px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td.status {
            color: green;
            font-weight: bold;
        }

        table td.cancel {
            color: orange;
            font-weight: bold;
        }
    </style>

    <script src="../asset/transaction_search.js"></script>

</head>
<body>

<header>
    <h1>Dashboard</h1>
</header>

<!-- Statistics Section -->
<div class="stats">
    <div class="card">
        
        <?php
        $completed = 0;
        $pending = 0;
        foreach ($usertransactions as $transaction) {
            if ($transaction['status'] == 'Done') {
                $completed++;
            } elseif ($transaction['status'] == 'Pending') {
                $pending++;
            }
        }
        $pend_percentage = round((($pending / ($completed + $pending)) * 100), 2);
        $comp_percentage = round((($completed / ($completed + $pending)) * 100), 2);
        ?>

        <h2><?php echo $completed ?></h2>
        <p>Completed</p>
        <p style="color: red;">▼ <?php echo $comp_percentage ?>% from last week</p>
    </div>
    <div class="card">
        <h2><?php echo $pending ?></h2>
        <p>Peding</p>
        <p style="color: red;">▼ <?php echo $pend_percentage ?>% from last week</p>
    </div>
</div>

<!-- Search Bar and Filters -->
<div class="controls">
    <input type="text" placeholder="Search..." id="searchInput">
    <button id="searchButton">Filter</button>
    <button id="clearButton">Clear</button>
</div>

<!-- Data Table -->

<!-- transaction table of user's transactions -->
<div id="transactionTable">
<?php
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Transac ID #</th>';
    echo '<th>City / State</th>';
    echo '<th>Station Company</th>';
    echo '<th>Amount</th>';
    echo '<th>Date</th>';
    echo '<th>Status</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($usertransactions as $transac) {
        echo '<tr>';
        echo '<td>' . $transac['transaction_id'] . '</td>';
        echo '<td>' . $transac['city'] . '</td>';
        echo '<td>' . $transac['station_company'] . '</td>';
        echo '<td>' . $transac['amount'] . '</td>';
        echo '<td>' . $transac['date'] . '</td>';
        echo ($transac['status'] == 'Done') ? '<td class="status">' . $transac['status'] . '</td>' : '<td class="cancel">' . $transac['status'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
         
?>
</div>

</body>
</html>


