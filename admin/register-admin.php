<?php
    session_start(); // Start the session
    // Initialize your database connection and define SITEURL here
    // Replace your database connection details below
    define('SITEURL', 'http://localhost/Agro-Shop/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'agro');

    // Database Connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Use password_hash for secure password storage

        // SQL Query
        $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            header("location: admin/login.php"); // Use the correct URL
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aradhana Agro Register</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="admin.php" title="Logo">
                    <img src="../img/Logo.png" alt="Agro Logo" class="img-responsive">
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <div class="main-content">
        <div class="wrapper">
            <h1>Register Admin</h1>
            <br /><br/>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name : </td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Full Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>User Name : </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Your User Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Password : </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Your Password" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Register" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

<?php include('partials/footer.php'); ?>
