<?php include "config.php"; include "includes/navbar.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$p = dermalux_get_product($id);
$imagePath = "assets/img/" . intval($p['id']) . ".jpg";
?>
<main class="container section">
    <div class="product-page">
        <div class="product-gallery">
            <img class="product-page-image" src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
        </div>

        <div class="product-info">
            <p class="eyebrow">DERMALUX LAB</p>
            <h1 class="product-title"><?php echo htmlspecialchars($p['name']); ?></h1>
            <p class="product-page-desc"><?php echo htmlspecialchars($p['description']); ?></p>

            <div class="product-price-row">
                <span class="price large">€<?php echo number_format($p['price'], 2); ?></span>
                <span class="stock-pill">In stock</span>
            </div>

            <div class="product-actions">
                <a href="checkout.php?id=<?php echo intval($p['id']); ?>" class="btn btn-dark">Buy now</a>
                <a href="products.php" class="btn btn-light">Back to shop</a>
            </div>

            <div class="info-box">
                <strong>Why you'll love it</strong>
                <p>Hydration-focused texture, premium finish, and a minimalist visual style inspired by modern Shopify skincare brands.</p>
            </div>
        </div>
    </div>

    <section class="reviews-section">
        <div class="section-head">
            <div>
                <p class="eyebrow">COMMUNITY</p>
                <h2>Reviews</h2>
            </div>
        </div>

        <form method="POST" class="review-form">
            <textarea name="review" placeholder="Leave your review..."></textarea>
            <button class="btn btn-dark">Add review</button>
        </form>

        <div class="reviews-list">
            <?php
            if ($_POST && isset($_POST['review']) && db_is_connected()) {
                $rev = $_POST['review'];
                $conn->query("INSERT INTO reviews(content) VALUES('$rev')");
            }

            if (db_is_connected()) {
                $r = $conn->query("SELECT * FROM reviews ORDER BY id DESC");
                while ($row = $r->fetch_assoc()) {
                    echo "<div class='review-card'><p>" . $row['content'] . "</p></div>"; // intentional XSS for CTF
                }
            } else {
                echo "<div class='review-card'><p>Demo mode: database non disponibile, recensioni non salvate.</p></div>";
            }
            ?>
        </div>
    </section>
</main>
<?php include "footer.php"; ?>