<?php
if (!isset($page_title)) {
    $page_title = 'Users Area';
}
$url = $url ?? '';
$is_logged_in = isset($_SESSION['user_id']); // Check if user is logged in
?>
<!doctype html>

<html lang="en">
<head>
    <title>KrateCMS
        <?php if (isset($page_title)) {
            echo '- ' . h($page_title);
        } ?><?php if (isset($preview) && $preview) {
            echo ' [PREVIEW]';
        } ?>
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo STYLES_PATH; ?>/style.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH; ?>/public.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">KrateCMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/contacts/">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users/">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/staff/">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/staff/admins/">Admins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/demos/">Demos</a>
                </li>
            </ul>
            <!-- Update navbar text to reflect user status -->
            <span class="navbar-text">
            <?php if ($is_logged_in): ?>
                Welcome back, <?= htmlspecialchars($_SESSION['first_name']); ?>! <a href="/users/logout.php">Log Out</a>
            <?php else: ?>
                Welcome Guest! Please <a href="/users/login.php">Log In</a> or <a
                    href="/public/users/register.php">Register</a>.
            <?php endif; ?>
        </span>
        </div>
    </div>
</nav>

<?php echo display_session_message(); ?>
