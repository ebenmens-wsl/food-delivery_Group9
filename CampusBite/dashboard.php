<?php
session_start();

// SESSION CHECK - Protect page
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Initialize orders
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = array();
}

$message = "";
$order_success = false;

// Get prefilled food using $_GET
$prefill = isset($_GET['food']) ? $_GET['food'] : '';

// ========================================
// HANDLE ORDER using $_POST
// ========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $food = $_POST['food'];
    $qty = (int)$_POST['quantity'];
    $address = trim($_POST['address']);
    
    // VALIDATION using if/elseif
    if (empty($food)) {
        $message = "Select a food item";
    }
    elseif ($qty < 1 || $qty > 10) {
        $message = "Quantity: 1-10";
    }
    elseif (empty($address) || strlen($address) < 10) {
        $message = "Enter detailed address (min 10 chars)";
    }
    else {
        // ========================================
        // SWITCH STATEMENT for pricing
        // ========================================
        $price = 0;
        
        switch ($food) {
            case 'Jollof Rice':
                $price = 70.00;
                break;
            case 'Waakye':
                $price = 50.00;
                break;
            case 'Banku':
                $price = 80.00;
                break;
            case 'Fufu':
                $price = 85.00;
                break;
            case 'Kelewele':
                $price = 40.00;
                break;
            case 'Kenkey':
                $price = 60.00;
                break;
            case 'Fried Rice':
                $price = 80.00;
                break;
            case 'Pizza':
                $price = 85.00;
                break;
            case 'Red Red':
                $price = 70.00;
                break;
            case 'Banku and Okro':
                $price = 75.00;
                break;
            case 'Chicken Chips':
                $price = 60.00;
                break;
            case 'Meat Pie':
                $price = 50.00;
                break;
            default:
                $message = "Invalid food";
        }
        
        if ($price > 0) {
            $total = $price * $qty;
            
            // Save order with SANITIZATION
            $_SESSION['orders'][] = array(
                'id' => 'ORD' . time(),
                'food' => htmlspecialchars($food),
                'qty' => $qty,
                'price' => $price,
                'total' => $total,
                'address' => htmlspecialchars($address),
                'date' => date('Y-m-d H:i')
            );
            
            $order_success = true;
            $message = "Order placed!";
        }
    }
}

// Calculate stats
$total_orders = count($_SESSION['orders']);
$total_spent = 0;
foreach ($_SESSION['orders'] as $o) {
    $total_spent += $o['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CampusBite</title>
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
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- SECTION -->
    <section>
        
        <!-- PROFILE -->
        <div class="profile-box">
            <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Photo" class="profile-img">
            <div class="profile-info">
                <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
            </div>
        </div>

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-num"><?php echo $total_orders; ?></div>
                <div class="stat-label">Orders</div>
            </div>
            <div class="stat-box">
                <div class="stat-num" style="color: #00b894;">GH₵ <?php echo number_format($total_spent, 2); ?></div>
                <div class="stat-label">Spent</div>
            </div>
        </div>

        <!-- ORDER FORM -->
        <div class="order-section">
            <h3>🛒 Place New Order</h3>
            
            <?php if ($message): ?>
                <div class="msg <?php echo $order_success ? 'msg-success' : 'msg-error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($order_success): ?>
                <!-- Show receipt -->
                <div class="receipt">
                    <p class="text-center" style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">🧾 Order Confirmed!</p>
                    <?php $last = end($_SESSION['orders']); ?>
                    <div class="receipt-line">
                        <span>Order ID:</span>
                        <strong><?php echo $last['id']; ?></strong>
                    </div>
                    <div class="receipt-line">
                        <span>Food:</span>
                        <strong><?php echo $last['food']; ?></strong>
                    </div>
                    <div class="receipt-line">
                        <span>Quantity:</span>
                        <strong><?php echo $last['qty']; ?></strong>
                    </div>
                    <div class="receipt-line">
                        <span>Address:</span>
                        <strong><?php echo $last['address']; ?></strong>
                    </div>
                    <div class="receipt-line receipt-total">
                        <span>TOTAL:</span>
                        <strong>GH₵ <?php echo number_format($last['total'], 2); ?></strong>
                    </div>
                </div>
                <div class="text-center mt-20">
                    <a href="dashboard.php" class="btn btn-blue btn-sm">Place Another Order</a>
                </div>
            <?php else: ?>
            
            <form method="POST">
                
                <div class="form-group">
                    <label>Select Food *</label>
                    <select name="food" required>
                        <option value="">-- Choose --</option>
                        <option value="Jollof Rice" <?php echo ($prefill == 'Jollof Rice') ? 'selected' : ''; ?>>Jollof Rice - GH₵ 70</option>
                        <option value="Waakye" <?php echo ($prefill == 'Waakye') ? 'selected' : ''; ?>>Waakye - GH₵ 50</option>
                        <option value="Banku" <?php echo ($prefill == 'Banku') ? 'selected' : ''; ?>>Banku & Tilapia - GH₵ 80</option>
                        <option value="Fufu" <?php echo ($prefill == 'Fufu') ? 'selected' : ''; ?>>Fufu & Soup - GH₵ 85</option>
                        <option value="Kelewele" <?php echo ($prefill == 'Kelewele') ? 'selected' : ''; ?>>Kelewele - GH₵ 40</option>
                        <option value="Kenkey" <?php echo ($prefill == 'Kenkey') ? 'selected' : ''; ?>>Kenkey & Fish - GH₵ 60</option>
                        <option value="Fried Rice" <?php echo ($prefill == 'Fried Rice') ? 'selected' : ''; ?>>Fried Rice - GH₵ 80</option>
                        <option value="Pizza" <?php echo ($prefill == 'Pizza') ? 'selected' : ''; ?>>Pizza - GH₵ 85</option>
                        <option value="Red Red" <?php echo ($prefill == 'Red Red') ? 'selected' : ''; ?>>Red Red - GH₵ 70</option>
                        <option value="Banku and Okro" <?php echo ($prefill == 'Banku and Okro') ? 'selected' : ''; ?>>Banku & Okro Stew - GH₵ 75</option>
                        <option value="Chicken Chips" <?php echo ($prefill == 'Chicken Chips') ? 'selected' : ''; ?>>Crunchy Chicken & Fries - GH₵ 60</option>
                        <option value="Meat Pie" <?php echo ($prefill == 'Meat Pie') ? 'selected' : ''; ?>>Meat Pie - GH₵ 50</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Quantity * (1-10)</label>
                    <input type="number" name="quantity" value="1" min="1" max="10" required>
                </div>
                
                <div class="form-group">
                    <label>Delivery Address *</label>
                    <textarea name="address" placeholder="Hostel name, room number, landmarks..." required></textarea>
                </div>
                
                <button type="submit" class="btn btn-block">Place Order</button>
                
            </form>
            
            <?php endif; ?>
        </div>

        <!-- ORDER HISTORY -->
        <div class="order-section">
            <h3> Order History </h3>
            
            <?php if (empty($_SESSION['orders'])): ?>
                <div class="empty">
                    <p>No orders yet. Place your first order above!</p>
                </div>
            <?php else: ?>
                
                <?php foreach (array_reverse($_SESSION['orders']) as $order): ?>
                <div class="order-item">
                    <div class="order-head">
                        <span class="order-id">#<?php echo $order['id']; ?></span>
                        <span class="order-date"><?php echo $order['date']; ?></span>
                    </div>
                    <p class="order-food"><?php echo htmlspecialchars($order['food']); ?> × <?php echo $order['qty']; ?></p>
                    <p class="order-addr">📍 <?php echo htmlspecialchars($order['address']); ?></p>
                    <p class="order-total">GH₵ <?php echo number_format($order['total'], 2); ?></p>
                </div>
                <?php endforeach; ?>
                
            <?php endif; ?>
        </div>

    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 CampusBite Ghana. Group 9 Back-End Web Development Project.</p>
    </footer>

</body>
</html>