<?php


function getConnection(){
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'webtech');
    return $conn;
}

function login($username, $password){
    $conn = getConnection();
    $sql = "select * from users where username='{$username}' and password='{$password}'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count ==1){
        return true;
    }else{
        return false;
    }
} 


function getUserID($username, $password){
    $conn = getConnection();
    $sql = "select * from users where username='{$username}' and password='{$password}'";
    $result = mysqli_query($conn, $sql);
    
    if ($row = $result->fetch_assoc()) {
        // Verify the password
        // if (password_verify($password, $row['password'])) {
            return $row['id']; // Return the user ID
        // }
    }

    return false; // Return false if login fails
} 

function userExists($username, $email) {
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE username='{$username}' OR email='{$email}'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0; // Returns true if user exists
}

function addUser($username, $password, $email){
    $conn = getConnection();
    $sql = "insert into users VALUES('', '{$username}', '{$password}', '{$email}')";
    if(mysqli_query($conn, $sql)){
        return true;
    }else{
        return false;                                   
    }
}

function getUsernameById($user_id) {
    $conn = getConnection();
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row['username'];
}

function getSubscriptionById($user_id) {
    $conn = getConnection();
    $sql = "SELECT subscription FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row['subscription'];
}

function getAllUser(){
    $users = [];
    $conn = getConnection();
    $sql = "select * from users";
    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<br>";
            array_push($users, $row);
        }
        return $users;
    }
    else{
        return false;
    }
}

function getTransactionAllById($user_id){
    $transactions = [];
    $conn = getConnection();
    $sql = "select * from transactions where user_id = $user_id";
    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<br>";
            array_push($transactions, $row);
        }
        return $transactions;
    }
    else{
        return false;
    }
}

function getTransactionAll(){
    $transactions = [];
    $conn = getConnection();
    $sql = "select * from transactions";
    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo "<br>";
            array_push($transactions, $row);
        }
        return $transactions;
    }
    else{
        return false;
    }
}


function getTransactionByUser($user_id){
    $transactions = [];
    $conn = getConnection();
    $sql = " SELECT t.* FROM transactions t JOIN users u ON u.id = t.user_id WHERE u.id = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); //result obj
    while($row = mysqli_fetch_assoc($result)){
        array_push($transactions, $row);
    }
    mysqli_stmt_close($stmt);
    return $transactions;
}

//search transactions
function searchTransactionByUser($user_id, $query) {
    $conn = getConnection();
    $sql = "SELECT * FROM transactions WHERE user_id = ? AND (transaction_id LIKE ? OR city LIKE ? OR station_company LIKE ? OR amount LIKE ? OR date LIKE ? OR status LIKE ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $likeQuery = '%' . $query . '%';
    mysqli_stmt_bind_param($stmt, 'issssss', $user_id, $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $transactions;
}


// Bookings

function getAllStations(){
    $stations = [];
    $conn = getConnection();
    $sql = "select * from stations";
    $result = mysqli_query($conn, $sql);
    $stations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $stations;

    // if(mysqli_query($conn, $sql)){
    //     $result = mysqli_query($conn, $sql);
    //     while($row = mysqli_fetch_assoc($result)){
    //         // echo "<br>";
    //         array_push($stations, $row);
    //     }
    //     return $stations;
    // }
    // else{
    //     return false;
    // }
}

function getStationDetails($station_name) {
    $conn = getConnection();

    $sql = "SELECT * FROM stations WHERE st_name = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $station_name);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        return $row; 
    } else {
        return false;
    }
}

function searchStationByCity($city) {
    $conn = getConnection();

    $sql = "SELECT * FROM stations WHERE city = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $city);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $row; 

    } else {
        return false;
    }
}

function searchStationByCityMultiple($city) {
    $conn = getConnection();

    $sql = "SELECT * FROM stations WHERE city = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $city);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $row; 

}


//search stations
function searchByStations($query) {
    $conn = getConnection();
    $sql = "SELECT * FROM stations WHERE (st_name LIKE ? OR st_address LIKE ? OR city LIKE ? OR st_slot LIKE ? OR st_status LIKE ? OR st_price LIKE ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $likeQuery = '%' . $query . '%';
    mysqli_stmt_bind_param($stmt, 'sssssi', $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $stations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $stations;
}


function getBookingsByUser($user_id){
    $bookings = [];
    $conn = getConnection();
    $sql = " SELECT r.* FROM reservations r JOIN users u ON u.id = r.user_id WHERE u.id = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); //result obj
    while($row = mysqli_fetch_assoc($result)){
        array_push($bookings, $row);
    }
    mysqli_stmt_close($stmt);
    return $bookings;
}

function createBookingUser($user_id, $transaction_id, $amount, $city, $date, $status, $station_company) {
    $conn = getConnection();
    $sql = "INSERT INTO transactions (user_id, transaction_id, amount, city, date, status, station_company) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('mysqli error: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'iidsiss', $user_id, $transaction_id, $amount, $city, $date, $status, $station_company);

    if (!mysqli_stmt_execute($stmt)) {
        die('mysqli_stmt error: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return true; // Indicate success
}


function updateBookingUser($user_id, $transaction_id) {
    $conn = getConnection();
    $sql = "UPDATE transactions SET status = 'Done' WHERE user_id = ? AND transaction_id = ? AND status = 'Pending'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $user_id, $transaction_id);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

//invoice
function createInvoiceUser($user_id, $transaction_id, $invoice_no, $amount, $city, $date, $status, $station_company){
    $invoices = [];
    $conn = getConnection();
    $sql = " INSERT INTO invoices (user_id, transaction_id, invoice_no, amount, city, date, status, station_company) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ";
    
    if (!mysqli_prepare($conn, $sql)) {
        die('mysqli error: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, 'iiidsiss', $user_id, $transaction_id, $invoice_no, $amount, $city, $date, $status, $station_company);

    if (!mysqli_stmt_execute($stmt)) {
        die('mysqli_stmt error: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return true;
}




?>



