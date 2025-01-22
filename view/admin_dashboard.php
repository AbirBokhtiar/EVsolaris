<?php
session_start();


require_once '../model/db.php';


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../view/login.php");
    exit();
}


$total_users = getTotalUsers($conn);
?>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="icon" href="../image/r1.png" type="image/gif/png">
    
</head>
<body>

    
    <div >
        <h1>Admin Dashboard</h1>
        <div>Logged in as: Admin</div>
    </div>


    <div>
        <h2>Admin Panel</h2>
        <ul>
            
            <li><a href="../controller/user_management/user_management_admin.php">User Management</a></li>
            <li><a href="../controller/user_registration/user_registration_approval_admin.php">User Registration Approval</a></li>
            <li><a href="../controller/charging_station/charging_station_management_admin.php">Charging Station Management</a></li>
            <li><a href="../controller/energy_analytics/energy_analytics_admin.php">Energy Analytics</a></li>
            <li><a href="../controller/transaction/transaction_management_admin.php">Transaction Management</a></li>
            <li><a href="../view/delete.php">Remove User</a></li> 
            <li><a href="../controller/logout.php">Logout</a></li>
        </ul>
    </div>

    
    <div>
        <h2>Welcome to the Admin Dashboard</h2>
        <div>
            <div>
                <h3>Total Users</h3>
                <p><?php echo htmlspecialchars($total_users); ?></p>
            </div>
            
            <div>
                <h3>System Status</h3>
                <p>Operational</p>
            </div>
        </div>
        <div>
            <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
