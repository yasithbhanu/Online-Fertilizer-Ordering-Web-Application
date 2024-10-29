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
    <section class="agro-menu">

        <div class="login">
            <fieldset>
                <legend>Register</legend>
                <form action="register_process.php" method="post" class="text-center">
                    <input type="text" name="full_name" placeholder="Full Name" required><br><br>
                    <input type="text" name="username" placeholder="Username" required><br><br>
                    <input type="password" name="password" placeholder="Password" required><br><br>
                    <input type="text" name="phone" placeholder="Phone Number" required><br><br>
                    <input type="text" name="address" placeholder="Address" required><br><br>
                    <button type="submit">Register</button><br><br>
                </form>

                <p class="text-center">Already have an account? <a href="user-login.php">Login</a></p>
            </fieldset>
        </div>
    </section>

    <?php
// Your database connection code goes here

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            // Insert into the 'tbl_cust' table
            $sql_cust = "INSERT INTO tbl_cust (full_name, phone_no, address) VALUES ('$full_name', '$phone', '$address')";

            $result_cust = mysqli_query($conn, $sql_cust);
            

            if ($result_cust) {
                // Registration was successful
                header("Location: user-login.php"); // Redirect to login page
            } else {
                // Registration failed
                echo "Registration failed.";
            }
        }
    ?>


    <?php include('partials/footerus.php'); ?>
