<?php
session_start();
require_once "config.php";
include "includes/navbar.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 1; $product = dermalux_get_product($id); ?>
<main class="container section"><div class="product-detail"><div class="product-detail-image"><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></div><div class="product-detail-info"><p class="eyebrow">DERMALUX CARE</p><h1><?php echo htmlspecialchars($product['name']); ?></h1><p><?php echo htmlspecialchars($product['description']); ?></p><p class="detail-price">€<?php echo number_format((float)$product['price'], 2); ?></p><a href="checkout.php?id=<?php echo intval($product['id']); ?>" class="btn btn-dark">Checkout</a><div class="hint-box"><strong>Challenge hint</strong><p>Il sito usa un cookie chiamato <code>DLX_SESSION</code>. Alcuni permessi possono rivelare contenuti nascosti dopo il refresh.</p></div></div></div></main>
<script src="assets/js/app.js"></script>
<?php include "includes/footer.php"; ?>