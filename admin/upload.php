<?php include("includes/header.php"); ?>

<?php 
    if(!$session->is_signed_in())
    {
        redirect("login.php");//////it is a userdefined function
    }
?>


<?php 
    $message = "";
    if(isset($_POST['submit']))
    {
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->set_file($_FILES['file_upload']);

        if($photo->save())
        {
            $message = "Photo is succesfully uploaded ";
        }
        else{
            $message = join("<br>", $photo->errors);
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
                            Uploads
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        <h1><?php  echo $message ?></h1>
                        <div class="col-md-6">   
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="text" class="form-control"  name="title">
                                </div>
                                <div class="form-group">
                                <input type="file" name="file_upload">
                                </div>
                                <input type="submit"   name="submit">
                            </form>
                        </div> 

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>