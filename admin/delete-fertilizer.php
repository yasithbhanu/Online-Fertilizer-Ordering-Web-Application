<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../img/ferti/".$image_name;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Fertilizer Image</div>";
                header('location:'.SITEURL.'admin/manage-fertilizer.php');

                die();
            }
        }

        $sql = "DELETE FROM tbl_fertilizer WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Fertilizer Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-fertilizer.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Fertilizer!.</div>";
            header('location:'.SITEURL.'admin/manage-fertilizer.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-fertilizer.php');
    }

?>