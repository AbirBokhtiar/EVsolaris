<?php
require_once('../model/userModel.php');
require_once('../model/db.php');
session_start();

$user_id = $_SESSION['user_id'];
$query = isset($_GET['query']) ? $_GET['query'] : '';

if ($query === '') {
    $usertransactions = getTransactionByUser($user_id);
} else {
    $usertransactions = searchTransactionByUser($user_id, $query);
}

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