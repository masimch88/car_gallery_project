<?php include("includes/header.php"); ?>

<?php

if(!$session->is_signed_in())
{
    redirect("login.php");//////it is a userdefined function
}

?>

<?php 
/*
if(empty($_GET['id']))
{
    redirect("photos.php");
}
else
{
    $photo = Photo::find_by_id($_GET['id']);

    if(isset($_POST['update']))
    {
        if($photo)
        {
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alernate_text = $_POST['alternate_text'];
            $photo->description = $_POST['description'];
            
            $photo->save();
        }
    }
}*/

?>


<?php 
    $message = "";
    if(isset($_POST['submit']))
    {
        $user = new User();
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];

       $user->set_file($_FILES['file_upload']);

        if($user->upload_photo())
        {
            $user->save();
            $message = "User is succesfully uploaded ";
        }
        else{
            //join function return returns a string from the elements of an array. always use two parameters 
            $message = join("<br>", $user->errors);
        }
    }


?>



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
                            Photo
                            <small>Edit </small>
                        </h1>
                        


                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit Photo
                            </li>
                        </ol>

                        <form action="" method="post" enctype="multipart/form-data">

                        
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <div class="form-group">
                                    
                                    <label for="username">Usename</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" >
                                </div>
                                
                                <div class="form-group">
                                     <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                <label for="user_image">Upload Image</label>
                                    <input type="file" name="file_upload">
                                </div>
                                
                                <input type="submit"   name="submit" class="btn btn-primary pull-right">
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