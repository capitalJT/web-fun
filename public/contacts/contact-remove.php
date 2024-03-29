<?php
require_once('../../private/initialize.php');

require_login();

$title = "Contacts | Remove Contact";
// this is for <title>

$page_heading = "This is the DB Test page";
// This is for breadcrumbs if I want a custom title other than the default

$page_subheading = "Welcome to the DB test page";
// This is the subheading

$custom_class = "db-test-page";
//custom CSS for this page only

$contact_set = find_all_contacts();
// From globe_bank tutorial

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

    <section>
        <h2>Remove Contact(s)</h2>
        <p>Please select the contact(s) to delete from `email_list` and click Remove.</p>

        <a class="btn btn-outline-info mb-4 font-weight-bold" href="<?php echo url_for('/contacts/index.php'); ?>">&laquo; Back to List</a>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php
                $dbc = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
                or die('Error connecting to MySQL server.');

                // Delete the customer rows (only if the form has been submitted)
                if (isset($_POST['submit'])) {
                    foreach ($_POST['todelete'] as $delete_id) {
                        $query = "DELETE FROM email_list WHERE id='" . $delete_id ."'";
                        mysqli_query($dbc, $query)
                        or die('Error querying database.');
                    }
                    echo "Contact(s) removed.<br />";
                }

                // Display the customer rows with checkboxes for deleting
                $query = "SELECT * FROM email_list";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
                    echo $row['first_name'];
                    echo ' ' . $row['last_name'];
                    echo ' ' . $row['email'];
                    echo '<br />';
                }

                mysqli_close($dbc);
            ?>

            <input type="submit" name="submit" value="Remove" class="btn btn-primary mt-4" />
        </form>
    </section>
</div>

<?php include_once(INCLUDES_PATH . '/site-footer.php'); ?>