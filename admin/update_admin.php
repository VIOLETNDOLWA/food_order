<?php include('partial/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        ob_start();
        //1. get the ID of selected Admin
        $id=$_GET['id'];

        //2. create SQL querry to get the details
        $sql = "SELECT * FROM tbt_admin WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not
        if($res==true){
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1){
                //get the details
                $row=mysqli_fetch_assoc($res);

                $full_name = $row["full_name"];
                $user_name =$row["user_name"];
            }else{
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-small">
                <tr>
                    <td>Full Name:  </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:  </td>
                    <td>
                        <input type="text" name="user_name" value="<?php echo $user_name;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

//check whether the button is clicked or not
if(isset($_POST['submit'])){
    //echo "button clicked";
    //get all the value from form to update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $user_name=$_POST['user_name'];

    //create a sql query to update admin
    $sql = "UPDATE tbt_admin SET
    full_name = '$full_name',
    user_name = '$user_name'
    WHERE id ='$id'
    ";

    //execute the query
    $res = mysqli_query($conn,$sql);

    //check whether the query executed succesfully or not
    if($res==true){
        //query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Succesfully.</div";
        //redirect to manage page
        header('location:'.SITEURL."admin/manage_admin.php");
    }else{
        $_SESSION['update'] = "<div class='error'>Failed to delete.</div";
        //redirect to manage admin page
        header('location:'.SITEURL."admin/manage_admin.php");
    }
}
?>
<?php include('partial/footer.php');?>