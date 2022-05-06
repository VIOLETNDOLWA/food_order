<?php
include('../config/const.php');
//1. get the ID of Admin to be deleted
$id =$_GET['id'];

//2. create sql querry to delete Admin
$sql = "DELETE FROM tbt_admin WHERE id=$id";

//Execute the querry
$res = mysqli_query($conn, $sql);

//check whether the query executed succesfully or not
if($res==true){
    //query executed succesfully and admin deleted
    //echo "Admin deleted";
    $_SESSION['delete'] ="<div class='success'>Admin Deleted Succesfully</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL."admin/manage_admin.php");
}else{
    //failed to delete
    //echo "Failed to delete";
    $_SESSION['delete'] ="<div class='error'> Failed to Delete. Try Again Later</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL."admin/manage_admin.php");
}
//3. Redirect to manage admin page with message (success/error)
?>
