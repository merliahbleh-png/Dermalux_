<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$cookieFlag = 'CTF{dermalux_cookie_flag}';
$showCookieFlag = false;
if (isset($_COOKIE['DLX_SESSION'])) {
    $decodedCookie = base64_decode($_COOKIE['DLX_SESSION'], true);
    if ($decodedCookie !== false && stripos($decodedCookie, 'admin') !== false) {
        $showCookieFlag = true;
    }
}
?>
<link rel="stylesheet" href="assets/css/style.css">
<header class="site-header">
    <div class="announcement-bar">Free shipping on orders over €49</div>
    <?php if ($showCookieFlag): ?>
        <div class="flag-top-banner">
            🎉 Flag trovata: <strong><?php echo htmlspecialchars($cookieFlag); ?></strong>
        </div>
    <?php endif; ?>
    <nav class="navbar">
        <a class="brand" href="index.php">DERMALUX</a>

        <div class="nav-center">
            <a href="index.php">Shop</a>
            <a href="products.php">All Products</a>
            <a href="checkout.php?id=1">Checkout</a>
        </div>

        <div class="nav-right">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="account-pill"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
            <?php else: ?>
                <a href="login.php" class="account-link">Account</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
