<?php include('partials/list.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Fertilizer</h1>

        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql2 = "SELECT * FROM tbl_fertilizer WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                $count = mysqli_num_rows($res2);

                if($count==1)
                {
                    $row2 = mysqli_fetch_assoc($res2);
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                    $current_image = $row2['image_name'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found!</div>";
                    header('location:'.SITEURL.'admin/manage-fertilizer.php');
                }

            }
            else
            {
                header('location:'.SITEURL.'admin/manage-fertilizer.php');
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
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                $sql = "SELECT * FROM tbl_cat WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];

                                            ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                            
                                        }
                                    }
                                    else
                                    {
                                        echo "<option value='0'>Category Not Available!</option>";
                                    }

                            ?>  
                        </select>
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
                                <img src="<?php echo SITEURL; ?>img/ferti/<?php echo $current_image; ?>" width="150px">
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
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $current_image = $_POST['current_image'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        $image_name_parts = explode('.', $image_name);
                        $ext = end($image_name_parts);

                        $image_name = "Agro_Fertilizer_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../img/ferti/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/manage-fertilizer.php');
                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path = "../img/ferti/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image!</div>";
                                header('location:'.SITEURL.'admin/manage-fertilizer.php');
                                die();
                            } 
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                
                

                $sql3 = "UPDATE tbl_fertilizer SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    category_id = '$category_id',
                    featured = '$featured',
                    active = '$active', 
                    image_name = '$image_name'
                    WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);

                if ($res3 == true) {
                    $_SESSION['update'] = "<div class='success'>Fertilizer Updated Successfully.</div>";
                    header('location: ' . SITEURL . 'admin/manage-fertilizer.php');
                    exit; // Exit immediately after the header to prevent further output
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Fertilizer!</div>";
                    header('location: ' . SITEURL . 'admin/manage-fertilizer.php');
                    exit; // Exit immediately after the header to prevent further output
                }
            }
        ?>

    </div>
</div>
