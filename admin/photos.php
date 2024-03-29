<?php include("includes/header.php"); ?>

<?php
if(!$session->is_signed_in())
{
  redirect("login.php");
}
?>

<?php
$photos = Photo::find_all();;
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
                    <small>Photos</small>
                </h1>
                <a href="user_photos.php" class="btn btn-primary">See your photos</a>
                <p class="bg-success"><?php echo $message; ?></p>
                <div class="col-md-12">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Photo</th>
                        <th>Id</th>
                        <th>File Name</th>
                        <th>Title</th>
                        <th>Size</th>
                        <th>Comments</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach($photos as $photo) : ?>
                    <tr>
                      <td><img src='<?php echo $photo->picture_path(); ?>' alt='' class="admin-photo-thumbnail">
                        <div class="action_links">
                          <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                          <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                          <a href="delete_photo.php?id=<?php echo $photo->id ?>" class="delete_link">Delete</a>
                        </div>
                      </td>
                      <td><?php echo $photo->id; ?></td>
                      <td><?php echo $photo->filename; ?></td>
                      <td><?php echo $photo->title; ?></td>
                      <td><?php echo $photo->size; ?></td>
                      <td>
                        <a href="photo_comments.php?id=<?php echo $photo->id ?>">
                          <?php
                          $comments = Comment::find_the_comments($photo->id);
                          echo count($comments);
                          ?>
                        </a>
                      </td>
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
