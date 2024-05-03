<?php
require_once('../../private/initialize.php');

require_login();

    // $id = isset($_GET['id']) ? $_GET['id'] : '1';
    $id = $_GET['id'] ?? '1'; // PHP > 7.0

    $contact = find_contact_by_id($id);


    $title = "DB Test Page";
    // this is for <title>

    $page_heading = "This is the DB Test page";
    // This is for breadcrumbs if I want a custom title other than the default

    $page_subheading = "Welcome to the DB test page";
    // This is the subheading

    $custom_class = "db-test-page";
    //custom CSS for this page only

include_once(INCLUDES_PATH . '/site-header.php');

?>

<div class="container <?php echo $custom_class; ?>">
    <?php
        include_once(INCLUDES_PATH . '/masthead.php');
        include_once(INCLUDES_PATH . '/navigation.php');
    ?>

    <section>
        <?php include_once(INCLUDES_PATH . '/headline-page.php');?>
        <?php include_once(INCLUDES_PATH . '/db-menu.php');?>
    </section>

    <div class="row">
        <div class="col">
            <section>
                <div id="content" class="">
                    <a class="btn btn-outline-info mb-4 font-weight-bold" href="<?php echo url_for('/contacts/index.php'); ?>">&laquo; Back to List</a>

                    <div class="contact show mb-4">
                        <h1 class="h3">Contact: <?php echo h($contact['first_name']) . " " . h($contact['last_name'] ); ?></h1>

                        <div class="attributes">

                            <?php
                            if($contact['image'] == '') {
                                    echo '<img src="uploads/no-image.png" alt="image" style="max-width: 200px;">';
                                } else {
                                    echo '<div class="contact-image mb-3">';
                                    echo '<img src="uploads/' . h($contact['image']) . '" alt="image" style="max-width: 200px;">';
                                    echo '</div>';
                                }
                            ?>

                            <dl class="mb-2">
                                <dt>First Name</dt>
                                <dd class="font-weight-bold h5"><?php echo h($contact['first_name']); ?></dd>
                            </dl>
                            <dl class="mb-2">
                                <dt>Last Name</dt>
                                <dd class="font-weight-bold h5"><?php echo h($contact['last_name']); ?></dd>
                            </dl>
                            <dl class="mb-2">
                                <dt>Contact Number</dt>

                                <?php
                                    if ($contact['contact_number'] == '') {
                                        echo '<dd class="font-weight-bold">No contact number</dd>';
                                    } else {
                                        echo '<dd class="font-weight-bold h5"><a href="tel:' . h($contact['contact_number']) . '">' . h($contact['contact_number']) . '</a></dd>';
                                    }
                                ?>
                            </dl>

                            <dl class="mb-2">
                                <dt>Email</dt>

                                <?php
                                if ($contact['email'] == '') {
                                    echo '<dd class="font-weight-bold">No contact email address</dd>';
                                } else {
                                    echo '<dd class="font-weight-bold h5"><a href="mailto:' . h($contact['email']) . '">' . h($contact['email']) . '</a></dd>';
                                }
                                ?>

                            </dl>

                            <dl class="mb-2">
                                <dt>Comments</dt>

                                <?php
                                    if ($contact['comments'] == '') {
                                        echo '<dd class="font-weight-bold">No comments</dd>';
                                    } else {
                                        echo '<dd class="font-weight-bold">' . h($contact['comments']) . '</dd>';
                                    }
                                ?>
                            </dl>
                        </div><!-- end .attributes -->
                    </div><!-- end .contact -->

                    <a class="btn btn-warning font-weight-bold" href="<?php echo url_for('/contacts/contact-edit.php?id=' . h(u($contact['id']))); ?>">Edit Contact</a>
                    <a class="btn btn-success font-weight-bold" href="<?php echo url_for('/contacts/contact-message.php?id=' . h(u($contact['id']))); ?>">Send Message &raquo;</a>

                </div><!-- end #content -->
            </section>
        </div><!-- end .col -->
    </div><!-- end .row -->

</div><!-- end .container -->

<?php include_once(INCLUDES_PATH . '/site-footer.php'); ?>