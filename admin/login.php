<?php include("../config/const.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-centre">Login</h1>
        <br>

        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>
        <!-- login form start -->
        <form action="" method="POST" class="text-centre">
            username:<br>
            <input type="text" name="user_name" placeholder="Entre username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Entre password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
        <!-- login form end -->
    </div>
    
</body>
</html>
<?php
//check wheather the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //1.Get the data from login form
    //$user_name = $_POST['user_name'];
    //$password = md5($_POST['password']);
    $user_name =mysqli_real_escape_string($conn, $_POST['user_name']);
    $password =mysqli_real_escape_string($conn, md5($_POST['password']));
    //2. sql to check wheather the user with username and password exist or not
    $sql = "SELECT * FROM tbt_admin WHERE user_name='$user_name' AND password='$password'";

    //3. execute the query
    $res= mysqli_query($conn, $sql);

    //4. count rows to check whether the user exist or not
    $count = mysqli_num_rows($res);
    if($count==1){
        //user available and login success
        $_SESSION['login'] ="<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $user_name;//to check whether the user is login or not and logout will unset it
        //redirect to home page
        header('location:'.SITEURL.'admin/');
        }else{
            $_SESSION['login'] ="<div class='error text-centre'>Username or Password did not match.</div>";
        //redirect to home page
        header('location:'.SITEURL.'admin/login.php');
        }
}
?>