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
                    <small>Dashboard</small>
                </h1>

                <?php include('includes/admin_content.php') ?>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
