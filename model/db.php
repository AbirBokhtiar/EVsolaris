<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "webtech";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ##registration #forgot password
function emailExists($email, $conn) {
    $sql = "SELECT * FROM userslogin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}

// ##registration new user
function registerUser($firstname, $lastname, $phonenumber, $address, $email, $password, $conn) {
    $sql = "INSERT INTO userslogin (first_name, last_name, phone_number, address, email, password) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssisss", $firstname, $lastname, $phonenumber, $address, $email, $password);
    return mysqli_stmt_execute($stmt);
}

// ##login
function getUserByEmail($email, $conn) {
    $sql = "SELECT * FROM userslogin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result); 
}

// ##login verify the password 
function verifyPassword($inputPassword, $storedPassword) {
    return $inputPassword === $storedPassword; 
}

// ##admin
function getTotalUsers($conn) {
    $sql = "SELECT COUNT(*) as total FROM userslogin";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    } else {
        return "Error fetching data";
    }
}

//  ##user ##change password
function getUserById($user_id, $conn) {
    $sql = "SELECT * FROM userslogin WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

//password by id 
 
function getUserPasswordById($id) {
    global $conn;
    $query = "SELECT password FROM userslogin WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


 //update the user password by id
 
function updateUserPassword($id, $new_password) {
    global $conn;
    $query = "UPDATE userslogin SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_password, $id);
    return $stmt->execute();
}

//##delete from admin dashboard
function deleteUserByEmail($email) {
    global $conn;
    $query = "DELETE FROM userslogin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->affected_rows;
}

function fetchAllUsers() {
    global $conn;
    $query = "SELECT id, first_name, last_name, phone_number, email, address FROM userslogin";
    $result = $conn->query($query);
    return $result;
}

//##account delete
function fetchPasswordByEmail($email, $conn) {
    $query = "SELECT password FROM userslogin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['password'] ?? null;
}

// Function to delete a user by email
function deleteUsersByEmail($email, $conn) {
    $query = "DELETE FROM userslogin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    return $stmt->execute();
}

//##edit, ##profile
function getUserDetails($user_id, $conn) {
    $query = "SELECT first_name, last_name, phone_number, address, email FROM userslogin WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Update user profile
function updateUserProfile($user_id, $first_name, $last_name, $phone_number, $address, $email, $conn) {
    $query = "UPDATE userslogin SET first_name = ?, last_name = ?, phone_number = ?, address = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $first_name, $last_name, $phone_number, $address, $email, $user_id);
    return $stmt->execute();
}

//##new password
function updateUserPasswordByEmail($email, $password) {
    global $conn;
    $query = "UPDATE userslogin SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $password, $email);
    return $stmt->execute();
}
?>
