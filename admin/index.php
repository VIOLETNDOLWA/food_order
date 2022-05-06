<?php include('partial/menu.php');?>

    <!-- main section start   -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <div class="col-4 text-centre">
            <h1>5</h1><br>
            catagories
        </div>

        <div class="col-4 text-centre">
            <h1>5</h1><br>
            catagories
        </div>

        <div class="col-4 text-centre">
            <h1>5</h1><br>
            catagories
        </div>

        <div class="col-4 text-centre">
            <h1>5</h1><br>
            catagories
        </div>

        <div class="clearfix"></div>

        
    </div>
    </div>
    <!-- main section end   -->

    <?php include('partial/footer.php');?>