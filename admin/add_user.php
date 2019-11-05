<?php include("includes/header.php"); ?>

<?php
if(!$session->is_signed_in())
{
  redirect("login.php");
}
?>

<?php
$the_message = "";
$user = new User();
if(isset($_POST['create']))
{
  if($user)
  {
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    $user->set_file($_FILES['user_image']);

    if($user->upload_photo())
    {
      $the_message = "User has been created";
    }
    else
    {
      $the_message = join("<br>", $user->errors);
    }
  }
}
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <!-- Top Menu Items -->
    <?php include('includes/top_nav.php') ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include('includes/side_nav.php') ?>

</nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Create User
                    <small>Subheading</small>
                </h1>
                <form class="" action="" method="post" enctype="multipart/form-data"><!-- action="add_user.php" -->
                  <h4 class="bg-danger"><?php echo $the_message; ?></h4>
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form_group">
                      <input type="file" name="user_image">
                    </div>
                    <div class="form-group">
                      <label for="first_name">First Name</label>
                      <input type="text" name="first_name" value="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" name="last_name" value="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username" value="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" value="" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="create" value="Create" class="btn btn-primary pull-right">
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
