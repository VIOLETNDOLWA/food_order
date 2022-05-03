<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
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
}else{
    //not clicked
}

?>