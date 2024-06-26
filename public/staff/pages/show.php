<?php require_once('../../../src/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page = find_page_by_id($id);

?>

<?php $page_title = 'Show Page'; ?>
<?php include('../../../templates/layout/header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-12">
            <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

            <div class="page show">

                <h1>Page: <?php echo h($page['menu_name']); ?></h1>

                <div class="actions">
                    <a class="action"
                       href="<?php echo url_for('/index.php?id=' . h(u($page['id'])) . '&preview=true'); ?>"
                       target="_blank">Preview</a>
                </div>

                <div class="attributes">
                    <?php $subject = find_subject_by_id($page['subject_id']); ?>
                    <dl>
                        <dt>Subject</dt>
                        <dd><?php echo h($subject['menu_name']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Menu Name</dt>
                        <dd><?php echo h($page['menu_name']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Position</dt>
                        <dd><?php echo h($page['position']); ?></dd>
                    </dl>
                    <dl>
                        <dt>Visible</dt>
                        <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
                    </dl>
                    <dl>
                        <dt>Content</dt>
                        <dd><?php echo h($page['content']); ?></dd>
                    </dl>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('../../../templates/layout/footer.php'); ?>
