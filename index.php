<?php
session_start();
require_once "config.php";
include "includes/navbar.php";
$products = dermalux_products();
?>
<?php if (cookie_reveals_flag()): ?><div class="flag-banner">Flag trovata: <strong><?php echo htmlspecialchars(current_flag()); ?></strong></div><?php endif; ?>
<main>
<section class="hero"><div class="hero-content"><p class="eyebrow">NEW SEASON ESSENTIALS</p><h1>Clinical skincare for luminous everyday skin</h1><p class="hero-text">Minimal formulas, premium textures, and routines designed to look like a real modern skincare brand.</p><div class="hero-actions"><a href="products.php" class="btn btn-dark">Shop all</a><a href="#best-sellers" class="btn btn-light">Best sellers</a></div></div></section>
<section class="feature-strip"><div>Dermatologist-inspired formulas</div><div>Hydration-first routines</div><div>Clean minimal aesthetic</div></section>
<section class="container section promo-hunt-section"><div class="promo-hunt-card"><p class="eyebrow">FREE PRODUCT CHALLENGE</p><h2>Se vuoi vincere un prodotto gratis, trova la flag</h2><p>La flag è nascosta nel sito. Portala alla pagina checkout e inseriscila nel campo premio: il prezzo iniziale verrà annullato e pagherai 0€.</p><a href="products.php" class="btn btn-dark">Inizia la ricerca</a></div></section>
<section id="best-sellers" class="container section"><div class="section-head"><div><p class="eyebrow">FEATURED</p><h2>Best sellers</h2></div><a href="products.php">View all</a></div><div class="product-grid">
<?php foreach ($products as $product): ?><article class="product-card"><a href="product.php?id=<?php echo intval($product['id']); ?>"><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></a><p class="product-badge">Best seller</p><h3><?php echo htmlspecialchars($product['name']); ?></h3><p><?php echo htmlspecialchars($product['description']); ?></p><div class="product-bottom"><span>€<?php echo number_format((float)$product['price'], 2); ?></span><a href="product.php?id=<?php echo intval($product['id']); ?>" class="btn btn-small">View</a></div></article><?php endforeach; ?>
</div></section></main>
<script src="assets/js/app.js"></script>
<?php include "includes/footer.php"; ?>