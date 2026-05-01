<?php include "config.php"; include "includes/navbar.php"; ?>
<main class="container section">
    <div class="section-head products-head">
        <div>
            <p class="eyebrow">SHOP ALL</p>
            <h1 class="page-title">Daily skincare essentials</h1>
        </div>
        <p class="products-subtitle">A cleaner, more premium storefront with fixed image sizing and a more Shopify-like layout.</p>
    </div>

    <div class="products-grid products-grid-all">
        <?php
        foreach (dermalux_get_products() as $row) {
            $imgPath = "assets/img/" . intval($row['id']) . ".jpg";
        ?>
            <article class="product-card">
                <a class="product-image-wrap" href="product.php?id=<?php echo intval($row['id']); ?>">
                    <img class="product-image" src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                </a>
                <div class="product-meta">
                    <p class="product-badge">Premium care</p>
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="product-desc"><?php echo htmlspecialchars($row['description']); ?></p>
                    <div class="product-bottom">
                        <span class="price">€<?php echo number_format($row['price'], 2); ?></span>
                        <a href="product.php?id=<?php echo intval($row['id']); ?>" class="btn btn-dark btn-small">View</a>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</main>
<?php include "footer.php"; ?>