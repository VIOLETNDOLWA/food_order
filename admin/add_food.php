<?php include('partial/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-small">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of The Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select image:</td>
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
                                    $id =$row['id'];
                                    $title =$row['title'];

                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }else{
                                //we donot have categories
                                ?>
                                <option value="0">No category Found</option>
                                <?php
                            }

                            //2.display on dropdown
                            ?>
                            <!-- <option value="1">Food</option>
                            <option value="2">Snacks</option> --> -->
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check whether the button is clicked or not
        if(isset($_POST['submit'])){
            //add the food in database
            //1. get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether the featured and active is checked or not
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                $featured = "No";//setting the default value
            }
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "No";//setting the default value
            }

            //2. upload the imsge if selected
            //check whether the select image is clicked or not and upload the image only if selected
            if(isset($_FILES['image']['name'])){

                //get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //check whether the image is selected or not and upload image if selected
                if($image_name!=""){
                    //image is selected
                    //a. Rename the image
                    //get the extension of selected image(jpg,png, etc)
                    $ext = end(explode('.', $image_name));

                    //create new name for image
                    $image_name = "Food_name".rand(0000,9999).'.'.$ext;//new image name

                    //b. upload the image
                    //get the source path and destination path

                    //source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uploaded
                    $dst = "../images/food".$image_name;

                    //finally upload the food image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image is uploaded or not
                    if($upload==false){

                        //failed to upload the image
                        //redirect to add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                        header('location:'.SITEURL.'admin/add_food.php');
                        //stop the process
                        die();
                    }
                }  

            }else{
                $image_name = ""; //setting default value as blank
            }
            
            //3.insert into database
            //create a sql query to save or add food
            $sql2 = "INSERT INTO tbt_food SET
            title = '$title',
            description = '$description',
            image_name = '$image_name',
            category_id = $category,
            price = $price,
            featured = '$featured',
            active = '$active'
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql);

            //check whether data inserted or not
            if($res2==true){
                $_SESSION['add'] ="<div class='error'>Food Added Succesfully.</div>";
            }
            //4. redirect with message to manage food page
        }
        ?>
    </div>
</div>

<?php include('partial/footer.php');?>