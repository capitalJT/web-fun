<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../src/initialize.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../src/classes/KrateUserManager.php');

use Fivetwofive\KrateCMS\KrateUserManager;

// Initialize the KrateUserManager with the existing $db connection
$userManager = new KrateUserManager($db);

// Check if user is already logged in
$userIsLoggedIn = $userManager->isLoggedIn();

if ($userIsLoggedIn) {
    $loggedInMessage = "You are already logged in.";
} else {
    $loggedInMessage = "Please log in.";
}

$error = ''; // Initialize error message

// Handle POST requests (either login or logout)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        // Log the user out
        $userManager->logout();
        header("Location: login.php");
        exit();
    }

    // Handle login process
    $username = htmlspecialchars($_POST['username']);  // Sanitize inputs
    $password = $_POST['password'];

    // Try to log in the user
    $loginResult = $userManager->login($username, $password);
    if ($loginResult) {
        // Log that login was successful for debugging purposes
        error_log("User logged in successfully: " . $loginResult['username']);

        // Store session data on successful login
        $_SESSION['user_id'] = $loginResult['user_id'];
        $_SESSION['username'] = $loginResult['username'];
        $_SESSION['first_name'] = $loginResult['first_name'];  // Store first name in session

        // Redirect to contacts page after successful login
        header("Location: /index.php");
        exit();
    } else {
        // Log that login failed for debugging purposes
        error_log("Login failed for username: " . $username);

        // Login failed, set the error message
        $error = "Invalid username or password!";
    }
}

include('../../templates/layout/header.php');
?>

  <div class="container py-5">
    <h1>User Login</h1>

        <?php if ($loggedInMessage): ?>
            <div class="alert alert-info" role="alert">
                <?= $loggedInMessage ?>
            </div>
        <?php endif; ?>

      <?php if ($userIsLoggedIn): ?>
        <form method="post">
          <button type="submit" name="logout" value="Log Out" class="btn btn-primary">Log Out</button>
        </form>
        <a href="index.php" class="btn btn-secondary">Go to main page</a>
      <?php else: ?>
      <div class="login-form border p-4">
        <form method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
          </div>
          <button type="submit" value="Login" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger mt-2"><?= $error ?></div>
      <?php endif; ?>
  </div>

<?php include('../../templates/layout/footer.php'); ?>