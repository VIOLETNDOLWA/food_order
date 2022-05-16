<?php include('partial/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>
        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-small">
                <tr>
                    <td>Title:  </td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:  </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                        
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add-category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form end -->

        <?php
        //check whether the submit button is clicked or not
        if(isset($_POST['submit'])){
            //echo "clicked";
            //1. get the value from category form
            $title = $_POST['title'];

            //for radio input, we need to check whether the button is selected or not
            if(isset($_POST['featured'])){
                //get the value from form
                $featured = $_POST['featured'];
            }else{
                //set the default value
                $featured = "No";
                
            }if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "No";
            }

            //check whether the image is selected or not and set the value for image name accordingly
            if(isset($_FILES['image']['name'])){
                //upload the image
                //print_r($_FILES['image']);
                //die();
                //to upload image we need:image name,source path and destination path
                $image_name = $_FILES['image']['name'];

                //upload the image only if image is selected
                if($image_name=!""){
                    //auto rename our image
                //get the extension of our image(jpg, png, gif, etc)
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "Food_category_".rand(000, 999).'.'.$ext;
                
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the proccess and redirect to error message
                if($upload==false){
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                    //redirect to add category page
                    header('location:'.SITEURL.'admin/add_category.php');
                    //stop the proccess
                    die();
                }
                    }
            }else{
                //don't upload image set the image value as blank
                $image_name ="";
            }
            
            //2. create sql query to insert category into database
            $sql = "INSERT INTO tbt_category SET
                title = '$title',
                image_name ='$image_name',
                featured = '$featured',
                active = '$active'
            ";

            //3. Execute the query and save in database
            $res =mysqli_query($conn, $sql);

            //4.check whether the query executed or not and data added or not
            if($res==true){
                //query executed and category added
                $_SESSION['add'] ="<div class='success'>Category Added Successfuly.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage_category.php');
            }else{
                //Failed to Add Category
                $_SESSION['add'] ="<div class='error'>Failed to Add Category.</div>";
                //redirect to manage category page
                header('location'.SITEURL.'admin/add_category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partial/footer.php');?>