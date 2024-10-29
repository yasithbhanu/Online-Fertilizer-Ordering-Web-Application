<?php include('partials/head.php'); 
    if (isset($_SESSION['username'])) {
        // User is logged in, show the order form
    } else {
        header("Location: user-login.php");
    }
?>

    <?php
        if(isset($_GET['fertilizer_id']))
        {
            $fertilizer_id = $_GET['fertilizer_id'];

            $sql = "SELECT * FROM tbl_fertilizer WHERE id=$fertilizer_id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>


    <!-- sEARCH Section Starts Here -->
    <section class="agro-order">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" method="POST" class="order">
                <fieldset>
                    <legend>Selected Fertilizer</legend>

                    <div class="agro-menu-img">

                    <?php
                        if($image_name=="")
                        {
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>img/ferti/<?php echo $image_name; ?>" alt="agro" class="img-responsive img-curve">
                            <?php
                        }

                    ?>

                        
                    </div>
    
                    <div class="agro-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name=fertilizer value="<?php echo $title; ?>">

                        <p class="agro-price"><?php echo $price; ?></p>
                        <input type="hidden" name=price value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Yasith Wijekoon" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0712150200" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. aradhanacom21@gmail.com" class="input-responsive">

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Aradhana, Dikkapitiya, Welimada." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $fertilizer = $_POST['fertilizer'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    $total = $price * $quantity;

                    $order_date = date("Y-m-d h:i:sa");

                    $status = "Ordered";

                    $customer_name = $_POST['full_name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql2 = "INSERT INTO tbl_order SET
                        fertilizer = '$fertilizer',
                        price = '$price',
                        quantity = '$quantity',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == true) 
                    {
                        $_SESSION['order'] = "<div class='text-center success'>Order Successfully.</div>";
                        header('location: ' . SITEURL);
                        exit();
                    } 
                    else 
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Order Failed.</div>";
                        header('location: ' . SITEURL);
                        exit();
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials/footerus.php'); ?>
