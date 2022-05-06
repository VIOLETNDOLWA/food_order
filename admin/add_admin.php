<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])){ //check wheather the session is set or not
            echo $_SESSION['add'];//displaying session message is set
            unset($_SESSION['add']);//removing session message
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-small">
                <tr>
                    <td>Full Name:  </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Entre Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username:  </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password:  </td>
                    <td>
                        <input type="password" name="password" placeholder="Your password">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partial/footer.php');?>

<?php
//process the value from form and save it in database
//chek whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //button clicked
   // echo "button is clicked";
    

    //step1:get data from a form
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);//password encryption with md5

    //step2: sql query to save data into database
    $sql = "INSERT INTO tbt_admin SET
        full_name = '$full_name',
        user_name = '$user_name',
        password = '$password'
    ";
    //step3:executing query and saving data into database
    $res = mysqli_query($conn, $sql);

    //step4: check wheather the (query is executed) data is inserted or not and displayed appropriate message
    if($res==TRUE){
    
    //create a session variables to display message
    $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
    //redirect page to manage admin
    header("location:".SITEURL.'admin/manage_admin.php');
    }else{
        //create a session variables to display message
    $_SESSION['add'] = "Failed to Add Admin";
    //redirect page to add admin
    header("location:".SITEURL.'admin/add_admin.php');
    }

}

?>