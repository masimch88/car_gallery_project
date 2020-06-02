<?php include("includes/header.php"); 

if(!$session->is_signed_in())
{
    redirect("login.php");//////it is a userdefined function
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
                            PHOTOS
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File name</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $photos = Photo::find_all(); ?>
                                <?php foreach ($photos as $photo) : ?>

                                    <tr>
                                        <td><img src="<?php echo $photo->picture_path(); ?>" alt="" >
                                        <div class="pictures_link">

                                         <a href="delete_photo.php/?id=<?php echo $photo->id; ?>">Delete</a>
                                         <a href="">Edit</a>
                                         <a href="">View</a>
                                        </div>
                                        </td>
                                        <td><?php echo $photo->id; ?></td>
                                        <td><?php echo $photo->file_name; ?></td>
                                        <td><?php echo $photo->title; ?></td>
                                        <td><?php echo $photo->size; ?></td>
                                    </tr>

                                <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>