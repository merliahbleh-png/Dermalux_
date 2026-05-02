<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<div class="top-bar">FREE SHIPPING ON ORDERS OVER €49</div>
<header class="navbar">
  <a href="index.php" class="brand">DERMALUX</a>
  <nav class="nav-links">
    <a href="index.php">Shop</a>
    <a href="products.php">All Products</a>
    <a href="checkout.php">Checkout</a>
  </nav>
  <div class="nav-account">
    <?php if (!empty($_SESSION['email'])): ?>
      <span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Account</a>
    <?php endif; ?>
  </div>
</header>
