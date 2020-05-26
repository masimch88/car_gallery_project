<?php include("includes/header.php"); ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <?php include "includes/top_nav.php"; ?>

        <?php include "includes/side_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <?php 

                        $sql = "SELECT * FROM users where id=1";
                        $result = $database->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        $database->the_insert_id();

                      //  echo $row['username'];

                        
                       /// $data = User::find_all_user();
                        $data = User::find_user_by_id(2);

                        $user = User::instansitation($data);

                
                        echo $user->id;
                        echo $user->username;
                        echo $user->password;
                        echo $user->first_name;
                        echo $user->last_name;
    






                        ?>



                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>