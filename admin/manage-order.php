<?php include('partials/list.php'); ?>

        <!-- Start Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Orders</h1>
                <br />

                <?php
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>No.</S></th>
                        <th>Fertilizer</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Done</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_order";

                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);

                            $no=1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $fertilizer=$rows['fertilizer'];
                                    $price=$rows['price'];
                                    $quantity=$rows['quantity'];
                                    $total=$rows['total'];
                                    $order_date=$rows['order_date'];
                                    $customer_name=$rows['customer_name'];
                                    $customer_address=$rows['customer_address'];
                                    $done=$rows['done'];


                                    ?>

                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $fertilizer; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td><?php echo $done; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/view-order.php?id=<?php echo $id; ?>" class="btn-primary"> View </a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else
                            {

                            }
                        }

                    ?>
                    
                </table>

        </div>
        <!-- End Content Section -->


<?php include('partials/footer.php'); ?>