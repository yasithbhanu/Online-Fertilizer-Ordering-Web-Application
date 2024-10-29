<?php include('partials/list.php'); ?>

        <!-- Start Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Fertilizer</h1>

                <br />

                <?php

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }

                ?>

                <br /><br /><br>

                <a href="<?php echo SITEURL; ?>admin/add-fertilizer.php" class="btn-primary">Add Fertilizer</a>
<br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>No.</S></th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        $sql = "SELECT * FROM tbl_fertilizer";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $no=1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                $image_name = $row['image_name'];

                                ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td> 
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <?php
                                            if($image_name=="")
                                            {
                                                echo "<div class='error'> Image Not Added.</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL; ?>img/ferti/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-fertilizer.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-fertilizer.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr> <td colspan='7' class='error'> Food Not Added Yet. </td></tr>";
                        }

                    ?>
                    
                </table>

        </div>
        <!-- End Content Section -->


<?php include('partials/footer.php'); ?>