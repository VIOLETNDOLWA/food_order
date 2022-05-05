<?php include('partial/menu.php');?>
    <!-- main section start   -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session message
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
                //$sn=1; //create a variable and assign the value
                
                //check the number of rows
                if($count>0){
                    //we have data in database
                    while($rows=mysqli_fetch_assoc($res));{
                    //using while loop to get all data from database
                    //while loop will run as long we have data in a database

                    //get individual data
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $user_name = $rows['user_name'];

                    //display the value in our table
                ?>

            <tr>
                <td><?php echo $id;?></td> 
                <td><?php echo $full_name;?></td>
                <td><?php echo $user_name;?></td>
                <td>
                    <a href="btn-secondary"> Update Admin</a>
                    <a href="btn-danger">  Delete Admin</a>
                    
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

            <tr>
                <td>1. </td>
                <td>Violet</td>
                <td>vio</td>
                <td>
                    <a href="btn-secondary"> Update Admin</a>
                    <a href="btn-danger">  Delete Admin</a>
                    
                </td>
            </tr>

            <tr>
                <td>2. </td>
                <td>Leila</td>
                <td>Lei</td>
                <td>
                <a href="btn-secondary"> Update Admin</a>
                    <a href="btn-danger">  Delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>3. </td>
                <td>Charles</td>
                <td>Charl</td>
                <td>
                <a href="btn-secondary"> Update Admin</a>
                    <a href="btn-danger">  Delete Admin</a>
                </td>
            </tr>
        </table>
    
    </div>
    </div>
    <!-- main section end   -->

    <?php include('partial/footer.php');?>

    