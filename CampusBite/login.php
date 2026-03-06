<?php
session_start();

// Redirect to dashborad if logged in
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

// Processing the form using $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // VALIDATION using if...else
    if (empty($email)) {
        $error = "Email is required";
    } else {
        if (empty($password)) {
            $error = "Password is required";
        } else {
            if (!isset($_SESSION['users'][$email])) {
                $error = "Email not found";
            } else {
                if (password_verify($password, $_SESSION['users'][$email]['password'])) {
                    // manage the session
                    $_SESSION['user'] = $_SESSION['users'][$email];
                    $_SESSION['logged_in'] = true;
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Wrong password";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CampusBite</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- HEADER ( NAME AND NAV) -->
    <header>
        <div class="header-container">
            <a href="index.html" class="logo">CampusBite</a>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="login.php" class="active">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- SECTION -->
    <section>
        <div class="card card-sm">
            
            <div class="text-center mb-20">
                <h2 class="card-title">Welcome Back!</h2>
            </div>
            
            <?php if ($error): ?>
                <div class="msg msg-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Your email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Your password" required>
                </div>
                
                <button type="submit" class="btn btn-block">Login</button>
                
            </form>
            
            <p class="text-center mt-20 text-muted">
                No account? <a href="register.php" class="link">Register here</a>
            </p>
            
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 CampusBite Ghana. Group 9 Back-End Web Development Project.</p>
    </footer>

</body>
</html>