<?php include('partials/head.php'); ?>

<section class="agro-order">
        <div class="container">
            
            <h2 class="text-center text-white">Your Order is Successfully Completed.</h2>

            <form action="#" method="POST" class="order">
                <fieldset>
                    <legend>Order Details</legend>

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

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class='text-center font-color='red'>Order Successfully.</div>";
                        header('location:'.SITEURL);
                        exit();
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Order Failed.</div>";
                        header('location:'.SITEURL);
                        exit();
                    }
                }
            ?>
            
        </div>
    </section>

<?php include('partials/footerus.php'); ?>




