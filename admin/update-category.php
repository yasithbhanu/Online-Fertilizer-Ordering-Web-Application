<?php include('partials/list.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_cat WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $current_image = $row['image_name'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>img/category/<?php echo $current_image; ?>" width="150px">
                                <?php 
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-change">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $current_image = $_POST['current_image'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));
                        
                        $image_name = "Agro_Category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../img/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-category.php');

                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path = "../img/category/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image!</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            } 
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }

                $sql2 = "UPDATE tbl_cat SET
                    title = '$title',
                    featured = '$featured',
                    active = '$active', 
                    image_name = '$image_name'
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='success'>Failed to Update Category!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>
