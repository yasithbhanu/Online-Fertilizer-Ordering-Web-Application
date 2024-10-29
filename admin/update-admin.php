<?php include('partials/list.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br/><br/>

            <?php
                $id=$_GET['id'];

                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                $res=mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            ?>

            <form action="" method="POST">

                <table class="tbl-30">

                    <tr>
                        <td>Full Name : </td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>User Name : </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            $sql = "UPDATE tbl_admin SET
            full_name = ?,
            username = ?
            WHERE id = ?
            ";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $full_name, $username, $id);
            $res = mysqli_stmt_execute($stmt);

            if ($res) {
                $_SESSION['update'] = "<div class='Success'>Admin Updated Successfully!</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Admin. Try Again!</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }


            /*$sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username,
            WHERE id='$id'
            ";

            /*$res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $_SESSION['update'] = "Admin Updated Successfully!";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                $_SESSION['update'] = "Failed to Update Admin. Try Again!";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }*/

    ?>