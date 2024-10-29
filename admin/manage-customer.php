<?php include('partials/list.php'); ?>

        <!-- Start Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Customers</h1>
                <br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                ?>

                <br /><br />

                <a href="add-customer.php" class="btn-primary">Add Customers</a>

                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>No.</S></th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>User Name</th>
                        <th>Action</th>
                        
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_cust";

                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);

                            $no=1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $us_id=$rows['us_id'];
                                    $full_name=$rows['full_name'];
                                    $address=$rows['address'];
                                    $phone_no=$rows['phone_no'];
                                    $username=$rows['username'];

                                    ?>

                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $phone_no; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/delete-customer.php?us_id=<?php echo $us_id; ?>" class="btn-delete">Delete Customer</a>
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