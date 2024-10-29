<?php include('partials/list.php'); ?>


        <div class="main-content">
            <div class="wrapper">
                <h1>Add Customer</h1>
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
                                <input type="text" name="full_name" placeholder="Enter Full Name">
                            </td>
                        </tr>

                        <tr>
                            <td>Address : </td>
                            <td>
                                <input type="text" name="address" placeholder="Enter Your Address">
                            </td>
                        </tr>

                        <tr>
                            <td>Phone No : </td>
                            <td>
                                <input type="text" name="phone_no" placeholder="Enter Your Phone Number">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>User Name : </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter Your User Name">
                            </td>
                        </tr>

                        <tr>
                            <td>Password : </td>
                            <td>
                                <input type="password" name="password" placeholder="Enter Your Password">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Customer" class="btn-change">
                            </td>
                        </tr>

                    </table>
                </form>



                <?php
                    //process the save form in database
                    if (isset($_POST['submit']))
                    {
                        $full_name = $_POST['full_name'];
                        $address = $_POST['address'];
                        $phone_no = $_POST['phone_no'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        //SQL Query
                        $sql = "INSERT INTO tbl_cust SET
                        full_name='$full_name',
                        address ='$address',
                        phone_no='$phone_no',
                        username='$username',
                        password='$password'
                        ";

                        $res = mysqli_query($conn, $sql); //or die(mysqli_error());

                        if($res==TRUE)
                        {
                            //echo "Data Inserted";
                            $_SESSION['add'] = "<div class='success'>Customer Added Successfully.</div>";

                            header("location:".SITEURL.'admin/manage-customer.php');
                        }
                        else
                        {
                            //echo "Failed to Insert Data";
                            $_SESSION['add'] = "<div class='error'>Failed to Add Customer.</div>";

                            header("location:".SITEURL.'admin/add-customer.php');
                        }

                    }
                ?>
                
            </div>
        </div>
