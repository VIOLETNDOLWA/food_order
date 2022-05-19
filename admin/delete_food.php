<?php
//include constant page
include('../config/const.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){
    //echo "process to delete";
    //1. get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2.remove the image if availabel
    //check whether the image is available or not and delete if available
    if($image_name !=""){

     //get the image path   
    $path = "../images/food/".$image_name;

    //remove image file from folder
    $remove = unlink($path);

    //check whether the image is removed or not
        if($remove==false){
        //failed to remove image
        $_SESSION['upload'] = "<div class='error'>Failed to remove  Image File</div>";
        //redirect to manage food
        header('location:'.SITEURL.'admin/manage_food.php');
        //stop the process
        die();
        }
}

    //3. delete from database
    $sql = "DELETE FROM tbt_food WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed or not and set session messege
    //4 redirect to manage food with session method
    if($res==true){
        //food deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }else{
        //failed to delete food
        $_SESSION['delete'] = "<div class='error'>Food to Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }

}else{
    //redirect to manage food page
    //echo "redirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauhorized Access.</div>";
    header('location:'.SITEURL.'admin/manage_food.php');
}
?>