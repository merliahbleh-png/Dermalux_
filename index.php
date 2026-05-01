<?php include "config.php"; include "includes/navbar.php"; ?>
<main>
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="eyebrow">NEW SEASON ESSENTIALS</p>
            <h1>Clinical skincare for luminous everyday skin</h1>
            <p class="hero-text">Minimal formulas, premium textures, and routines designed to look like a real modern skincare brand.</p>
            <div class="hero-actions">
                <a href="products.php" class="btn btn-dark">Shop all</a>
                <a href="products.php" class="btn btn-light">Best sellers</a>
            </div>
        </div>
    </section>

    <section class="feature-strip">
        <div>Dermatologist-inspired formulas</div>
        <div>Hydration-first routines</div>
        <div>Clean minimal aesthetic</div>
    </section>

    <section class="container section promo-hunt-section">
        <div class="promo-hunt-card">
            <p class="eyebrow">FREE PRODUCT CHALLENGE</p>
            <h2>Se vuoi vincere un prodotto gratis, trova la flag</h2>
            <p>La flag è nascosta nel sito. Portala alla pagina checkout e inseriscila nel campo premio: il prezzo iniziale verrà annullato e pagherai 0€.</p>
            <a href="products.php" class="btn btn-dark">Inizia la ricerca</a>
        </div>
    </section>

    <section class="section container">
        <div class="section-head">
            <div>
                <p class="eyebrow">FEATURED</p>
                <h2>Best sellers</h2>
            </div>
            <a href="products.php" class="text-link">View all</a>
        </div>

        <div class="products-grid">
            <?php
            foreach (dermalux_get_products(4) as $row) {
                $imgPath = "assets/img/" . intval($row['id']) . ".jpg";
            ?>
                <article class="product-card">
                    <a class="product-image-wrap" href="product.php?id=<?php echo intval($row['id']); ?>">
                        <img class="product-image" src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    </a>
                    <div class="product-meta">
                        <p class="product-badge">Best seller</p>
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
    </section>
</main>
<?php include "footer.php"; ?>