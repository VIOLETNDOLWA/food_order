<?php include('partial/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-small">
                <tr>
                    <td>Current password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>

                <tr>
                    <td>New password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" value="Change password" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //echo "clicked";
    //1. get the data from form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5(($_POST['new_password']));
    $confirm_password =md5(($_POST['confirm_password']));

    //2. check whether the user with the current ID and current pasword exist or not
    $sql = "SELECT * FROM tbt_admin WHERE id=$id AND  password='$current_password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    if($res==true){
        //check whether data is available or not
        $count=mysqli_num_rows($res);
        if($count==1){
            //user exist and password can be changed
            //echo "User Found";
            if($new_password==$confirm_password){
                //update the password
                $sql2 ="UPDATE tbt_admin SET
                password='$new_password'
                WHERE id=$id";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                
                //check whether the query is executed or not
                if($res2==true){
                    //display success message
                    $_SESSION['change password'] = "<div class='success'>Password changed succesfully .</div>";
                //redirect to manage admin page
                    header('location:'.SITEURL."admin/manage_admin.php");
                }else{
                    //display error message
                    $_SESSION['change password'] = "<div class='error'>Failed to Change Password .</div>";
                //redirect to manage admin page
                    header('location:'.SITEURL."admin/manage_admin.php");
                }
            }else{
                $_SESSION['password not match'] = "<div class='error'>Password Did Not Match.</div>";
                //redirect to manage admin page
                header('location:'.SITEURL."admin/manage_admin.php");
            }
        }else{
            //user does not exist set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            //redirect to manage admin page
        header('location:'.SITEURL."admin/manage_admin.php");
        }
    }
}
?>

<?php include('partial/footer.php');?>