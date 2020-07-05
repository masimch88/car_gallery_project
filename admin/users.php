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
                            users
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
                        <p class="bg-success"><?php echo $message; ?></p>
                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                        
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>username</th>
                                        <th>First Name</th>
                                        <th>Last name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $users = User::find_all(); ?>
                                <?php foreach ($users as $user) : ?>

                                    <tr>
                                    <td><?php echo $user->id; ?></td>
                                        <td ><img class="admin-user-thumbnail user-image" src="<?php echo $user->image_path_and_placeholder(); ?>" alt="" ></td>
                                        
                                        <td><?php echo $user->username; ?>
                                            <div class="action_link">
                                                <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                                <a href="">View</a>
                                            </div>
                                        </td> 
                                        <td><?php echo $user->first_name; ?></td>
                                        <td><?php echo $user->last_name; ?></td>
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