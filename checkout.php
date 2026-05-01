<?php include "config.php"; include "includes/navbar.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$product = dermalux_get_product($id);

$promoFlags = ['FLAG{cookie_handler_v2}', 'CTF{dermalux_cookie_flag}'];
$submittedFlag = trim($_POST['flag'] ?? '');
$flagIsValid = $_SERVER['REQUEST_METHOD'] === 'POST' && in_array($submittedFlag, $promoFlags, true);
$paymentAttempted = $_SERVER['REQUEST_METHOD'] === 'POST';
$total = $flagIsValid ? 0 : (float)$product['price'];
?>
<main class="container section">
    <div class="checkout-shell">
        <div class="checkout-left">
            <p class="eyebrow">CHECKOUT</p>
            <h1>Complete your order</h1>

            <div class="promo-checkout-banner">
                <strong>Vuoi vincere un prodotto gratis?</strong>
                <span>Trova la flag nascosta nel sito e inseriscila qui sotto: se è corretta, il totale diventa 0€.</span>
            </div>

            <form method="POST" action="checkout.php?id=<?php echo intval($product['id']); ?>" class="checkout-card">
                <?php if ($flagIsValid) { ?>
                    <div class="checkout-message success"><strong>Fatto, buon acquisto!</strong><br>Flag corretta: ordine confermato e prezzo annullato. Totale da pagare: 0€.</div>
                <?php } elseif ($paymentAttempted) { ?>
                    <div class="checkout-message error">Flag non valida o mancante. Pagamento momentaneamente non disponibile.</div>
                <?php } ?>

                <label>Email</label>
                <input type="email" name="email" placeholder="name@example.com">
                <label>Shipping address</label>
                <input type="text" name="address" placeholder="Street address">
                <div class="two-col">
                    <input type="text" name="city" placeholder="City">
                    <input type="text" name="zip" placeholder="ZIP code">
                </div>

                <label>Flag premio</label>
                <input type="text" name="flag" placeholder="FLAG{...}" value="<?php echo htmlspecialchars($submittedFlag); ?>">

                <?php if ($flagIsValid) { ?>
                    <button class="btn btn-dark full" type="submit">Completa checkout gratis - 0€</button>
                <?php } else { ?>
                    <button class="btn btn-dark full" type="submit">Verifica flag / Pay now</button>
                    <p class="payment-note">Senza flag valida il pagamento resta momentaneamente non disponibile.</p>
                <?php } ?>
            </form>
        </div>

        <aside class="checkout-right">
            <div class="order-card">
                <h3>Order summary</h3>
                <div class="summary-product">
                    <img src="assets/img/<?php echo intval($product['id']); ?>.jpg" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div>
                        <strong><?php echo htmlspecialchars($product['name']); ?></strong>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                    </div>
                </div>
                <div class="summary-row"><span>Product</span><span>€<?php echo number_format($product['price'], 2); ?></span></div>
                <?php if ($flagIsValid) { ?>
                    <div class="summary-row discount"><span>Flag reward</span><span>-€<?php echo number_format($product['price'], 2); ?></span></div>
                <?php } ?>
                <div class="summary-row"><span>Shipping</span><span>Free</span></div>
                <div class="summary-row total"><span>Total</span><span>€<?php echo number_format($total, 2); ?></span></div>
            </div>
        </aside>
    </div>
</main>
<script src="assets/js/app.js"></script>
<?php include "footer.php"; ?>