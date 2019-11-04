<?php include("includes/header.php"); ?>

<?php
if(!$session->is_signed_in())
{
  redirect("login.php");
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
                    <small>Subheading</small>
                </h1>

                <?php
                // $users = User::find_all();
                // foreach($users as $user)
                // {
                //   echo $user->username."<br>";
                // }
                // $user = new User();
                // $user->username = "SOME USERNAME";
                // $user->password = "123456789";
                // $user->first_name = "SOME FIRST NAME";
                // $user->last_name = "SOME LAST NAME";
                //
                // $user->create();

                // $user = new User();
                // $user->username = "SOME USERNAME";
                // $user->password = "123456789";
                // $user->first_name = "SOME FIRST NAME";
                // $user->last_name = "SOME LAST NAME";
                //
                // $user->save();

                // $user = User::find_by_id(9);
                // $user->first_name = 'Zoran';
                // $user->last_name = 'Zoric';
                // $user->update();

                // $user = User::find_by_id(5);
                // $user->delete();

                // $user = User::find_by_id(6);
                // $user->first_name = 'something';
                // $user->last_name = 'last something';
                // $user->password = '123456789';
                // $user->save();

                // $user = new User();
                // $user->username = 'new new username';
                // $user->save();

                // $photos = Photo::find_all();
                // foreach($photos as $photo)
                // {
                //   echo $photo->title."<br>";
                // }

                // $photo = new Photo();
                // $photo->title = "SOME TITLE";
                // $photo->description = "SOME DESCRIPTION";
                // $photo->filename = "SOME FILENAME";
                // $photo->type = "SOME TYPE";
                // $photo->size = 20;
                //
                // $photo->create();

                echo INCLUDES_PATH;

                ?>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
