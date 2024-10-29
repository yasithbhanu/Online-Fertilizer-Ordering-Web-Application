<?php

    include('../config/constants.php');

   //1. get the ID of admin to be deleted
    $us_id = $_GET['us_id'];

     //2. create SQL Query to delete Admin
     $sql = "DELETE FROM tbl_cust WHERE us_id=$us_id";

     $res = mysqli_query($conn, $sql);

     if($res==true)
     {
         $_SESSION['delete'] = "<div class='success'>Customer Deleted Successfully!</div>";
         header('location:'.SITEURL.'admin/manage-customer.php');
     }
     else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Customer. Try Again!</div>";
        header('location:'.SITEURL.'admin/manage-customer.php');
     }
    //3. Success or error message

?>