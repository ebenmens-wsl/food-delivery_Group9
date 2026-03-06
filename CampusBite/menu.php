<?php
session_start();
$logged_in = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - CampusBite</title>
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
                    <li><a href="menu.php" class="active">Menu</a></li>
                    <?php if ($logged_in): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- SECTION -->
    <section>
        
        <div class="page-title">
            <h2>Our Full Menu</h2>
            <p>Authentic Ghanaian dishes made fresh daily</p>
        </div>

        <div class="food-grid">
            
            <!-- FOOD 1 -->
            <div class="food-card">
                <img src="images/joff.jpg" alt="Jollof Rice" class="food-img">
                <div class="food-name">Jollof Rice</div>
                <p class="food-desc">Spicy Ghanaian jollof with grilled chicken</p>
                <div class="food-price">GH₵ 70.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Jollof Rice" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 2 -->
            <div class="food-card">
                <img src="images/waakye.jpg" alt="Waakye" class="food-img">
                <div class="food-name">Waakye</div>
                <p class="food-desc">Rice & beans with spaghetti, egg and stew</p>
                <div class="food-price">GH₵ 50.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Waakye" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 3 -->
            <div class="food-card">
                <img src="images/banku.jpg" alt="Banku" class="food-img">
                <div class="food-name">Banku & Tilapia</div>
                <p class="food-desc">Fresh banku with grilled tilapia and pepper</p>
                <div class="food-price">GH₵ 80.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Banku" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 4 -->
            <div class="food-card">
                <img src="images/fufu.jpg" alt="fufu" class="food-img">
                <div class="food-name">Fufu & Light Soup</div>
                <p class="food-desc">Pounded fufu with soup and goat meat</p>
                <div class="food-price">GH₵ 85.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Fufu" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 5 -->
            <div class="food-card">
                <img src="images/kele.jpg" alt="Kelewele" class="food-img">
                <div class="food-name">Kelewele</div>
                <p class="food-desc">Spicy fried plantain with groundnuts</p>
                <div class="food-price">GH₵ 40.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Kelewele" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 6 -->
            <div class="food-card">
                <img src="images/kenkey.jpg" alt="Kenkey" class="food-img">
                <div class="food-name">Kenkey & Fish</div>
                <p class="food-desc">Ga kenkey with fried fish and pepper</p>
                <div class="food-price">GH₵ 60.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Kenkey" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>
            

            <!-- FOOD 7 -->
            <div class="food-card">
                <img src="images/friedrice.jpg" alt="Fried Rice" class="food-img">
                <div class="food-name">Fried Rice</div>
                <p class="food-desc">Colorful fried rice with mixed vegetables and chicken</p>
                <div class="food-price">GH₵ 80.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Fried Rice" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 8 -->
            <div class="food-card">
                <img src="images/pizza.jpg" alt="Pizza" class="food-img">
                <div class="food-name">Pizza</div>
                <p class="food-desc">Cheesy pizza with your favorite toppings</p>
                <div class="food-price">GH₵ 85.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Pizza" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 9 -->
            <div class="food-card">
                <img src="images/redred.jpg" alt="Red Red" class="food-img">
                <div class="food-name">Red Red</div>
                <p class="food-desc">Black-eyed peas in palm oil sauce with fried plantain</p>
                <div class="food-price">GH₵ 70.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Red Red" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 10 -->
            <div class="food-card">
                <img src="images/bankuokro.jpg" alt="Banku & Okro Stew" class="food-img">
                <div class="food-name">Banku & Okro Stew</div>
                <p class="food-desc">Soft banku with okro soup and fish</p>
                <div class="food-price">GH₵ 75.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Banku and Okro" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 11 -->
            <div class="food-card">
                <img src="images/chickenchips.jpg" alt="Crunchy Chicken & Fries" class="food-img">
                <div class="food-name">Crunchy Chicken & Fries</div>
                <p class="food-desc">Fried chicken with crispy chips and ketchup</p>
                <div class="food-price">GH₵ 60.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Chicken Chips" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>

            <!-- FOOD 12 -->
            <div class="food-card">
                <img src="images/pie.jpg" alt="Meat Pie" class="food-img">
                <div class="food-name">Meat Pie</div>
                <p class="food-desc">Flaky pastry filled with spiced minced meat</p>
                <div class="food-price">GH₵ 50.00</div>
                <?php if ($logged_in): ?>
                    <a href="dashboard.php?food=Meat Pie" class="btn btn-sm btn-block">Order Now</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline btn-sm btn-block">Login to Order</a>
                <?php endif; ?>
            </div>
        </div>

    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 CampusBite Ghana. Group 9 Back-End Web Development Project.</p>
    </footer>

</body>
</html>