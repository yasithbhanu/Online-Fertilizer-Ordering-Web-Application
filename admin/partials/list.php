<?php 

    include('../config/constants.php');
    include('login-check.php');
?>

<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>

        <!-- Start Menu Section -->
        <div class="menu text-center">
            <div class="wrapper">
            <ul>
                    <li><a href="admin.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-fertilizer.php">Fertilizers</a></li>
                    <li><a href="manage-customer.php">Customers</a></li>
                    <li><a href="manage-order.php">Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>