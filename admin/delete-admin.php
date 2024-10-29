<?php

    include('../config/constants.php');

   //1. get the ID of admin to be deleted
    $id = $_GET['id'];

     //2. create SQL Query to delete Admin
     $sql = "DELETE FROM tbl_admin WHERE id=$id";

     $res = mysqli_query($conn, $sql);

     if($res==true)
     {
         $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully!</div>";
         header('location:'.SITEURL.'admin/manage-admin.php');
     }
     else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
     }
    //3. Success or error message

?>