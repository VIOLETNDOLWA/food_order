<?php
include('../config/const.php');
//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the value and delete
    //echo "Get Value and Delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file if availabe
    if($image_name!= ""){
        //image is available. so remove it
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if($remove==false){
            //set the session message
            $_SESSION['remove'] ="<div class='error'>Failed to Remove the Category Image</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage_category.php');
            //stop the process
            die();
        }
    }
    //Delete data from database
    //sql query to delete data from database
    $sql = "DELETE  FROM tbt_category WHERE id=$id";
    
    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the data is deleted from database or not
    if($res==true){
        //set succes message and redirect
        $_SESSION['delete'] ="<div class='success'>category image deleted successfuly.</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage_category.php');
        }else{
        //set fail message and redirect
        $_SESSION['delete'] ="<div class='error'>Failed to delete category image.</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage_category.php');
    }
}else{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage_category.php');
}
?>