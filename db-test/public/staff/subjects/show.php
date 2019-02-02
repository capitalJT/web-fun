<?php require_once ('../../../private/initialize.php');?>

<?php
//    $id = isset($_GET['id']) ? $_GET['id'] : '1';

$id = $_GET['id'] ?? '1'; // PHP > 7.0

?>

<?php $page_title = 'Show Subject'; ?>

<?php include (SHARED_PATH . '/staff_header.php');?>

<div id="content">

    <a href="<?php echo url_for('/staff/subjects/index.php')?>" class="back-link">&laquo; Back to Subjects List</a>
    <div class="subject show">
        <p>Subject ID: <?php echo h($id); ?></p>
    </div> <!-- end .subjects .listing -->
</div><!-- end #content -->

<?php include (SHARED_PATH . '/staff_footer.php');?>
