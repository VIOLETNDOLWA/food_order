<?php include('partial/menu.php');?>

<?php 
//check whether id is set or not
if(isset($_GET['id'])){
    //get all the details
    $id = $_GET['id'];
    //sql query to get all the selected food
    $sql2 = "SELECT * FROM tbt_food WHERE id=$id";
    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //get the individual values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}else{
    //redirect to manage food
    header('location:'.SITEURL.'admin/manage_food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-small">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                    <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php 
                        if($current_image == ""){
                            //image not available
                            echo "<div class='error'>Image not Available.</div>";
                        }else{
                            //image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="110px">
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //create php code to display categories from database
                            //1.create sql to get all active categories from database
                            $sql = "SELECT * FROM tbt_category WHERE active = 'Yes'";

                            //executing query
                            $res = mysqli_query($conn, $sql);

                            //count row to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //if count is greater than zero, we have categories else we donot have categories
                            if($count>0){
                                //we have categories
                                while($row=mysqli_fetch_assoc($res)){
                                    //get the details of categories
                                    $category_id =$row['id'];
                                    $category_title =$row['title'];
                                    ?>
                                    <option <?php if($current_category==$category_id){echo 'selected';}?> value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }else{
                                //we donot have categories
                                ?>
                                <option value="0">Food Not Found.</option>
                                <?php
                            }

                            ?>
                            
                        </select>
                    </td>
                </tr>

                

                <tr>
                    <td>Featured:</td>
                    <td>
                    <input <?php if($featured=='Yes'){echo 'checked';}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=='No'){echo 'checked';}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=='Yes'){echo 'checked';}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=='No'){echo 'checked';}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit'])){
            //echo "button clicked";

            //1. get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. upload the image if selected
            // A. Uploading the image
            //check whether upload button is clicked or not
            if(isset($_FILES['image']['name'])){
                //uploaded button clicked
                $image_name = $_FILES['image']['name']; //new image

                //check whether the file is available or not
                if($image_name!=""){
                    //image is available
                    //reneme the image
                    $ext = end(explode('.', $image_name)); //get the extensin of the image
                    $image_name = "Food_name".rand(0000,9999).'.'.$ext;//new image name

                    //get the source path and destination path
                    $src_path = $_FILES['image']['tmp_name']; //source path
                    $dest_path = "../images/food/".$image_name; //destination path

                    //upload the image 
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check whether the image is uploaded or not
                    if($upload==false){
                        //failed to upload
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image</div>";
                        header('location:'.SITEURL.'admin/manage_food.php');
                        //stop the process
                        die();
                    }
                    //3. remove the image if new image is uploaded and current image exist
                    // B. Remove current image if available
                    if($current_image!=""){
                        //current image is available
                        //redirect the image
                        $remove_path = "../images/food/".$current_image;
                        $remove = unlink($remove_path);

                        //check whether the image is removed or not
                        if($remove==false){
                            //failed to remove current image
                            $_SESSION['remove-failed'] ="<div class ='error'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage_food.php');
                            die();
                        }
                    }
                }
            }else{
                $image_name = $current_image;
            }

            

            //4. update the food in database
            $sql3 = "UPDATE tbt_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";
            //execute the sql query
            $res3 = mysqli_query($conn, $sql3);

            //check whether the query is executed or not
            if($res3==true){
                //query executed and food updated
                $_SESSION['update'] = "<div class ='success'>Food Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }else{
                $_SESSION['update'] = "<div class ='error'>Failed to Update Food.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }

            //5. redirect to manage food with session message
        }
        ?>
    </div>
</div>
<?php include('partial/footer.php');?>