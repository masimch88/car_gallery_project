<?php include("includes/header.php"); ?>

<?php

if(!$session->is_signed_in())
{
    redirect("login.php");//////it is a userdefined function
}

?>

<?php 

if(empty($_GET['id']))
{
    redirect("users.php");
}
else
{
    $user = User::find_by_id($_GET['id']);

    if(isset($_POST['update']))
    {
        if($user)
        {
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->password = $_POST['password'];

            

            if(empty($_FILES['file_upload']))
            {
                $user->save();
                $session->message("User has been updated");
                redirect("users.php");
                
            }
            else
            {
                $user->set_file($_FILES['file_upload']);
                $user->upload_photo();
                $user->save();
                $session->message("User has been updated");
               // redirect("edit_user.php?id={$user->id}");
               redirect("users.php");
              
            }
        }
       
    }
}

?>



<?php include "includes/photo_library_modal.php"; ?>






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
                            user
                            <small>Edit </small>
                        </h1>
                        


                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit user
                            </li>
                        </ol>
                        <div class="col-md-6 user_image_box">
                            <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
                            
                        </a>
                        </div>

                        <form action="" method="post" enctype="multipart/form-data">

                        
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <div class="form-group">
                                    
                                    <label for="username">Usename</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                                </div>
                                
                                <div class="form-group">
                                     <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control" value="<?php echo $user->password; ?>">
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="user_image">Upload Image</label>
                                    <input type="file" name="file_upload">
                                </div>
                                <div class="info-box-delete pull-left">
                                    <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger ">Delete</a>   
                                </div>
                                <input type="submit"   name="update" value="Update" class="btn btn-primary pull-right">
                            </div>

                        </div>
                        
                        
                    </div>
                </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>