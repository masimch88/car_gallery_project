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
                        Comments
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
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>author</th>
                                        <th>Body</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $comments = Comment::find_all(); ?>
                                <?php foreach ($comments as $comment) : ?>

                                    <tr>
                                    <td><?php echo $comment->id; ?></td>
                                        <td ><img class="admin-user-thumbnail user-image" src="<?php echo $comment->image_path_and_placeholder(); ?>" alt="" ></td>
                                        
                                        <td><?php echo $comment->author; ?>
                                            <div class="action_link">
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $comment->id; ?>">Edit</a>
                                                <a href="">View</a>
                                            </div>
                                        </td> 
                                        <td><?php echo $comment->body; ?></td>
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