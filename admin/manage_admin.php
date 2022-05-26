<?php include('partial/menu.php');?>
    <!-- main section start   -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php
        ob_start();
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session message
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if(isset($_SESSION['password not match'])){
            echo $_SESSION['password not match'];
            unset($_SESSION['password not match']);
        }
        if(isset($_SESSION['change password'])){
            echo $_SESSION['change password'];
            unset($_SESSION['change password']);
        }
        ?>
        <br><br><br>

        <!-- button to add admin -->
        <a href="add_admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            //query to get all admin
            $sql = "SELECT * FROM tbt_admin";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //check wheather the query is executed or not
            if($res==TRUE){
                //count rows to check wheather we have data in database or not
                $count = mysqli_num_rows($res); //function to get all the rows in a database
                $sn=1; //create a variable and assign the value
                
                //check the number of rows
                if($count>0){
                    //we have data in database
                    while($rows=mysqli_fetch_assoc($res)){
                    //using while loop to get all data from database
                    //while loop will run as long we have data in a database

                    //get individual data
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $user_name = $rows['user_name'];

                    //display the value in our table
                ?>

            <tr>
                <td><?php echo $sn++;?>.</td> 
                <td><?php echo $full_name;?></td>
                <td><?php echo $user_name;?></td>
                <td>
                    <a href="<?php echo SITEURL;?>admin/update_password.php? id=<?php echo $id?>" class="btn-primary">Change Password</a>
                    <a href="<?php echo SITEURL;?>admin/update_admin.php? id=<?php echo $id?>" class="btn-secondary"> Update Admin</a>
                    <a href="<?php echo SITEURL;?>admin/delete_admin.php? id=<?php echo $id?>" class="btn-danger">  Delete Admin</a>
                    
                </td>
            </tr>

                <?php
                }
                
            }
                else{
                    //we do not have data in database
                }
            }
            ?>

            
        </table>
    
    </div>
    </div>
    <!-- main section end   -->

    <?php include('partial/footer.php');?>

    