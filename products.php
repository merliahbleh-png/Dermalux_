<?php
session_start();
require_once "config.php";
include "includes/navbar.php";
$products = dermalux_products(); ?>
<main class="container section"><div class="section-head products-head"><div><p class="eyebrow">SHOP ALL</p><h1>Daily skincare essentials</h1></div><p class="products-subtitle">A cleaner, premium storefront with fixed image sizing and a modern layout.</p></div><div class="product-grid products-grid-all">
<?php foreach ($products as $product): ?><article class="product-card"><a href="product.php?id=<?php echo intval($product['id']); ?>"><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></a><p class="product-badge">Premium care</p><h3><?php echo htmlspecialchars($product['name']); ?></h3><p><?php echo htmlspecialchars($product['description']); ?></p><div class="product-bottom"><span>€<?php echo number_format((float)$product['price'], 2); ?></span><a href="product.php?id=<?php echo intval($product['id']); ?>" class="btn btn-dark btn-small">View</a></div></article><?php endforeach; ?>
</div></main>
<script src="assets/js/app.js"></script>
<?php include "includes/footer.php"; ?>