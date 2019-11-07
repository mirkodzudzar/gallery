<?php
require_once("admin/includes/init.php");

if(empty($_GET['id']))
{
  redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit']))
{
  $author = trim($_POST['author']);
  $body = trim($_POST['body']);


  $new_comment = Comment::create_comment($photo->id, $author, $body);

  if($new_comment && $new_comment->save())
  {
    $session->message("Your comment has been submited");
    redirect("photo.php?id={$photo->id}");
  }
  else
  {
    $session->message("There was some problems saving");
  }
}
else
{
  $author = "";
  $body = "";
  $date = "";
}

$comments = Comment::find_the_comments($photo->id);

?>

<?php include("includes/header.php"); ?>

<div class="row">
    <!-- Blog Post Content Column -->
    <div class="col-lg-12">
        <!-- Blog Posts -->
        <!-- Title -->
        <p class="bg-success"><?php echo $message; ?></p>
        <h1><?php echo $photo->title; ?></h1>
        <!-- Author -->
        <!-- <p class="lead">
            by <a href="#">Start Bootstrap</a>
        </p> -->
        <hr>
        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $photo->date; ?></p>
        <hr>
        <!-- Preview Image -->
        <img src="admin/<?php echo $photo->picture_path(); ?>" alt="<?php echo $photo->alternate_text; ?>" class="img-responsive">
        <hr>
        <!-- Post Content -->
        <p class="lead"><?php echo $photo->caption; ?></p>
        <p class="lead"><?php echo $photo->description; ?></p>
        <hr>
        <!-- Blog Comments -->
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="post" action="">
              <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="body">Comment</label>
                <textarea name="body" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <hr>
        <!-- Posted Comments -->

        <!-- Comment -->
        <?php foreach($comments as $comment) : ?>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $comment->author; ?>
                    <small><?php echo $comment->date; ?></small>
                </h4>
                <?php echo $comment->body; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- Blog Sidebar Widgets Column -->
    <!-- <div class="col-md-4">
      <?php //include("includes/sidebar.php"); ?>
    </div> -->
</div>
<!-- /.row -->
<?php include("includes/footer.php"); ?>
