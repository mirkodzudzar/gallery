<?php include("includes/header.php"); ?>

<?php
if(!$session->is_signed_in())
{
  redirect("login.php");
}
?>

<?php
if(isset($_FILES['file']))
{
  $photo = new Photo();
  $photo->user_id = $_SESSION['user_id'];
  $photo->title = $_POST['title'];
  $photo->set_file($_FILES['file']);
  if($photo->save())
  {
    $session->message("The photo {$photo->title} uploaded successfully");
    redirect('photos.php');
  }
  else
  {
    $session->message(join("<br>", $photo->errors));
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
                    Admin
                    <small>Upload</small>
                </h1>
                <p class="bg-success"><?php echo $message; ?></p>
                <div class="row">
                  <div class="col-md-6">
                    <form class="" action="upload.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" name="title" value="" placeholder="Title" class="form-control">
                      </div>
                      <div class="form-group">
                        <input type="file" name="file" value="">
                      </div>
                      <div class="form-group">
                        <input type="submit" name="submit" value="Submit">
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <form class="dropzone" action="upload.php" method="post">

                    </form>
                  </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
