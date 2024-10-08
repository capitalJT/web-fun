<?php
// Require initialization file
require_once($_SERVER['DOCUMENT_ROOT'] . '/../src/initialize.php');

// Check if user is logged in
$loggedIn = isset($_SESSION['user_id']);

// Check if previewing
$visible = !is_preview();

// Get the page id
if (isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = find_page_by_id($page_id, ['visible' => $visible]);
    if (!$page) {
        redirect_to(url_for('/page.php'));
    }
    $subject_id = $page['subject_id'];
    $subject = find_subject_by_id($subject_id, ['visible' => $visible]);
    if (!$subject) {
        redirect_to(url_for('/page.php'));
    }
} elseif (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
    $subject = find_subject_by_id($subject_id, ['visible' => $visible]);
    if (!$subject) {
        redirect_to(url_for('/page.php'));
    }
    $page_set = find_pages_by_subject_id($subject_id, ['visible' => $visible]);
    $page = mysqli_fetch_assoc($page_set); // first page
    mysqli_free_result($page_set);
    if (!$page) {
        redirect_to(url_for('/page.php'));
    }
    $page_id = $page['id'];
} else {
    // Todo: Find a better way at setting the homepage page id. THis doesn't work as expected.
    $page_id = '1';
}

?>

<?php include('../templates/layout/header.php'); ?>

<?php
    // If previewing, show an alert
    if (is_preview()) {
        show_preview_alert();
    }
?>

<div id="main" class="py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <?php include('../templates/components/nav_public.php'); ?>
      </div>

      <div class="col-md-9 ">
        <div class="page-content">
          <?php
          if (isset($page)) {
              // show the page from the database
              $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li><a><pre>';
              echo strip_tags($page['content'], $allowed_tags);
          } else {
              include('../templates/pages/static_homepage.php');
          }
          ?>
        </div><!-- end .page-content -->
          <?php
          if ($loggedIn) {
              echo '<a class="action btn btn-info mt-4" href="' . url_for('/staff/pages/edit.php?id=' . h(u($page_id))) . '">Edit Page</a>';
          }
          ?>
      </div><!-- end .col-md-9 -->
    </div>
  </div>
</div>

<?php include('../templates/layout/footer.php'); ?>
