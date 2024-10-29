<?php 
    session_start();
    include('config/db_connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate and check credentials (you should use password hashing in a production environment)
        $sql = "SELECT * FROM tbl_cust WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $_SESSION['username'] = $username;
            header("Location: Home.php");
        } else {
            echo "Invalid username or password";
        }
    }



/*if(isset($_POST['submit'])) {
    // Your login processing code here
    // ...
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_cust WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count == 1) {
        $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
        $_SESSION['user'] = $username;
        header('location:'.SITEURL.'Home.php');
        exit(); // Ensure script execution stops here
    } else {
        $_SESSION['login'] = "<div class='error text-center'>User Name or Password Incorrect.</div>";
        header('location:'.SITEURL.'user-login.php');
        exit(); // Ensure script execution stops here
    }
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aradhana Agro Login</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="Home.php" title="Logo">
                    <img src="img/Logo.png" alt="Agro Logo" class="img-responsive">
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->


    <!-- Menu Section Starts Here -->
    <section class="agro-menu">

        <div class="login">

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <fieldset>
                <legend> User Login</legend>
                <br/>

                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>
                <br/>

                <!-- Form Section Start Here -->
                <form action="" method="POST" class="text-center">
                    User Name:<br/>
                        <input type="text" name="username" placeholder="Enter Username"><br/><br/>
                    Password:<br/>
                        <input type="password" name="password" placeholder="Enter Password"><br/><br/>

                    <input type="submit" name="submit" value="Login" class="btn-log">
<br><br>
                    <p>You haven't an account? <a href="register.php">Register</a></p>
                </form>


                <!-- Form Section End Here -->
                </div>  
            </fieldset>
            

            <div class="clearfix"></div>            

        </div>
    </section>

    <?php include('partials/footerus.php'); ?>



