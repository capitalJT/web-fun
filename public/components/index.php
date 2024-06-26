<?php
    require_once '../../src/initialize.php';
    $title = "Components Page"; // this is for <title>
    $page_title = "This is the components page"; //this is for breadcrumbs if I want a custom title other than the default
    $addCSS = ""; //custom CSS for this page only
?>
<?php include('../../templates/layout/header.php'); ?>

<div class="container">
    <div class="site-inner">
        <div class="row">
            <div class="col-12 col-md-2 lorem-sidebar">
                <div class="article-list-wrapper sticky-top">
                    <span class="d-block font-weight-bold py-2">Components</span>
                </div>
            </div>
            <div class="col-12 col-md-10">
			    <?php include('slick-carousel.php'); ?>
			    <?php include('alerts.php'); ?>
			    <?php include('cards.php'); ?>
			    <?php include('jumbotron.php'); ?>
			    <?php include('nav-bar.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php include('../../templates/layout/footer.php'); ?>