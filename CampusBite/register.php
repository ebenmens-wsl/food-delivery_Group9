<?php
session_start();

// Initialize users
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$error = "";
$success = false;

// FORM PROCESSING using $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // VALIDATION using if / elseif / else
    if (empty($name)) {
        $error = "Name is required";
    }
    elseif (strlen($name) < 2) {
        $error = "Name must be at least 2 characters";
    }
    elseif (empty($email)) {
        $error = "Email is required";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }
    elseif (isset($_SESSION['users'][$email])) {
        $error = "Email already registered";
    }
    elseif (empty($phone)) {
        $error = "Phone is required";
    }
    elseif (strlen($phone) != 10) {
        $error = "Phone must be 10 digits";
    }
    elseif (empty($password)) {
        $error = "Password is required";
    }
    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    }
    elseif ($password !== $confirm) {
        $error = "Passwords do not match";
    }

    // FILE UPLOAD using $_FILES
    elseif (!isset($_FILES['photo']) || $_FILES['photo']['error'] != 0) {
        $error = "Profile photo is required";
    }
    else {
        $allowed = array('jpg', 'jpeg', 'png');
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed)) {
            $error = "Only JPG/PNG allowed";
        }
        elseif ($_FILES['photo']['size'] > 2000000) {
            $error = "Max file size is 2MB";
        }
        else {
            // Create folder
            if (!file_exists('uploads/profiles')) {
                mkdir('uploads/profiles', 0777, true);
            }
            
            $new_name = time() . '.' . $ext;
            $path = 'uploads/profiles/' . $new_name;
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
                // SANITIZATION using htmlspecialchars
                $_SESSION['users'][$email] = array(
                    'name' => htmlspecialchars($name),
                    'email' => htmlspecialchars($email),
                    'phone' => htmlspecialchars($phone),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'photo' => $path
                );
                $success = true;
            } else {
                $error = "Upload failed";
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
    <title>Register - CampusBite</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-container">
            <a href="index.html" class="logo">CampusBite</a>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="active">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- SECTION -->
    <section>
        <div class="card card-sm">
            
            <?php if (!$success): ?>
            
            <h2 class="card-title">Create Account</h2>
            
            <?php if ($error): ?>
                <div class="msg msg-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" placeholder="Your full name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" placeholder="email@example.com" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Phone * (10 digits)</label>
                    <input type="text" name="phone" placeholder="0241234567" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Password * (min 6 chars)</label>
                    <input type="password" name="password" placeholder="Create password" required>
                </div>
                
                <div class="form-group">
                    <label>Confirm Password *</label>
                    <input type="password" name="confirm_password" placeholder="Re-enter password" required>
                </div>
                
                <div class="form-group">
                    <label>Profile Photo * (JPG/PNG, max 2MB)</label>
                    <input type="file" name="photo" accept="image/*" required>
                </div>
                
                <button type="submit" class="btn btn-block">Create Account</button>
                
            </form>
            
            <p class="text-center mt-20 text-muted">
                Already registered? <a href="login.php" class="link">Login here</a>
            </p>
            
            <?php else: ?>
            
            <div class="text-center">
                <h2 class="card-title">Success!</h2>
                <p class="text-muted mb-20">Your account has been created.</p>
                <a href="login.php" class="btn">Login Now</a>
            </div>
            
            <?php endif; ?>
            
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 CampusBite Ghana. Group 9 Back-End Web Development Project.</p>
    </footer>

</body>
</html>