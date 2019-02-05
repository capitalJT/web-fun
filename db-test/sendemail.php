<?php
    require_once('../config.php');
?>

<?php include '../includes/site-header.php';?>
<div class="container">
  <?php include '../includes/masthead.php';?>
  <?php include '../includes/navigation.php';?>

  <section>
    <h2 class="h3"><span class="font-weight-bold">Private:</span> For Test use ONLY</h2>
    <p>Write and send an email to contact list members.</p>

    <?php

      if (isset($_POST['submit'])) {
        $from = 'jabaltorre@gmail.com';
        $subject = $_POST['subject'];
        $text = $_POST['emailtext'];
        $output_form = false;

        if (empty($subject) && empty($text)) {
          // We know both $subject AND $text are blank
          echo '<div class="border border-warning p-4 mb-4">You forgot the email subject and body text.</div>';
          $output_form = true;
        }

        if (empty($subject) && (!empty($text))) {
            echo '<div class="border border-warning p-4 mb-4">You forgot the email subject.</div>';
          $output_form = true;
        }

        if ( (!empty($subject)) && empty($text) ) {
            echo '<div class="border border-warning p-4 mb-4">You forgot the email body text.</div>';
          $output_form = true;
        }

      } else {
        $output_form = true;
        $subject = '';
        $text = '';
      }

      if ( (!empty($subject)) && (!empty($text)) ) {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
          or die('Error connecting to MySQL server.');

        $query = "SELECT * FROM email_list";
        $result = mysqli_query($dbc, $query)
          or die('Error querying database.');

        while ($row = mysqli_fetch_array($result)){
          $to = $row['email'];
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $msg = "Dear $first_name $last_name,\n$text";
          mail($to, $subject, $msg, 'From:' . $from);
          echo 'Email sent to: ' . $to . '<br />';
        }

        mysqli_close($dbc);
      }
    ?>

    <?php if ($output_form): ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="subject">Subject of email:</label><br />
            <input id="subject" name="subject" type="text" value="<?php echo $subject; ?>" size="30" /><br />
            <label for="emailtext">Body of email:</label><br />
            <textarea id="email-text" name="emailtext" rows="8" cols="40"><?php echo $text; ?></textarea><br />
            <input class="btn" type="submit" name="submit" value="Submit" />
        </form>
    <?php endif; ?>

  </section>

<?php include '../includes/site-footer.php';?>