<?php include('partials/list.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>View Order</h1>

            <br/><br/>

            <?php
                $id=$_GET['id'];

                $sql="SELECT * FROM tbl_order WHERE id=$id";

                $res=mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $rows=mysqli_fetch_assoc($res);

                        $id=$rows['id'];
                        $fertilizer=$rows['fertilizer'];
                        $price=$rows['price'];
                        $quantity=$rows['quantity'];
                        $total=$rows['total'];
                        $order_date=$rows['order_date'];
                        $customer_name=$rows['customer_name'];
                        $customer_contact=$rows['customer_contact'];
                        $customer_email=$rows['customer_email'];
                        $customer_address=$rows['customer_address'];
                        $done=$rows['done'];
                    }
                    else
                    {
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }

            ?>

            <form action="" method="POST">

                <table class="tbl-30">

                    <tr>
                        <td>Fertilizer : </td>
                        <td>
                            <input type="text" name="fertilizer" value="<?php echo $fertilizer; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Price : </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Quantity : </td>
                        <td>
                            <input type="text" name="quantity" value="<?php echo $quantity; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Total : </td>
                        <td>
                            <input type="text" name="total" value="<?php echo $total; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Order Date : </td>
                        <td>
                            <input type="text" name="order_date" value="<?php echo $order_date; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name : </td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact : </td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email : </td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address : </td>
                        <td>
                            <input type="text" name="customer_address" value="<?php echo $customer_address; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Order: </td>
                        <td>
                            <input <?php if($done=="Done"){echo "checked";} ?> type="radio" name="done" value="Done"> Complete
                            <input <?php if($done=="No"){echo "checked";} ?> type="radio" name="done" value="No"> No
                        </td>
                    </tr>



                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Back" class="btn-Primary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>

    <?php

        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $fertilizer=$_POST['fertilizer'];
            $price=$_POST['price'];
            $quantity=$_POST['quantity'];
            $total=$_POST['total'];
            $order_date=$_POST['order_date'];
            $customer_name=$_POST['customer_name'];
            $customer_contact=$_POST['customer_contact'];
            $customer_email=$_POST['customer_email'];
            $customer_address=$_POST['customer_address'];
            $done=$_POST['done'];

            $sql = "UPDATE tbl_order SET
            fertilizer = ?,
            price = ?,
            quantity = ?,
            total = ?,
            order_date = ?,
            customer_name = ?,
            customer_contact = ?,
            customer_email = ?,
            customer_address = ?,
            done = ?
            WHERE id = ?";

$sql3 = "INSERT INTO tbl_cust SET
full_name = '$customer_name',
phone_no = '$customer_contact',
address = '$customer_address'
";

//echo $sql2; die();


$res3 = mysqli_query($conn, $sql3);

            /*$sql = "UPDATE tbl_order SET
            fertilizer = $fertilizer,
            price= $price,
            quantity= $quantity,
            total= $total,
            order_date= $order_date,
            customer_name= $customer_name,
            customer_contact= $customer_contact,
            customer_email= $customer_email,
            customer_address= $customer_address,
            done= $done
            WHERE id = $id";*/

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sissssssssi", $fertilizer, $price, $quantity, $total, $order_date, $customer_name, $customer_contact, $customer_email, $customer_address, $done, $id);
            $res = mysqli_stmt_execute($stmt);

            if ($res) {
                $_SESSION['update'] = "<div class='success'>Order Confirm Successfully!</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Confirm the Order. Try Again!</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }


    ?>