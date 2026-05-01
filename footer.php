<footer class="site-footer">
    <div class="footer-inner container">
        <div>
            <h3>DERMALUX</h3>
            <p>Premium skincare inspired by modern direct-to-consumer brands.</p>
        </div>
        <div class="footer-links">
            <a href="products.php">Shop</a>
            <a href="checkout.php">Checkout</a>
            <a href="login.php">Account</a>
        </div>
    </div>
</footer>
<?php
function legacy_decode($d) { return base64_decode(str_rot13($d)); }
$part1 = "CTF{dermalux_";
if (isset($_COOKIE['DLX_SESSION'])) {
    $c = base64_decode($_COOKIE['DLX_SESSION']);
    if (strpos($c, "admin") !== false) {
        $res = $conn->query("SELECT note FROM logs LIMIT 1");
        $row = $res ? $res->fetch_assoc() : null;
        $part2 = "cookie_flag}";
        echo "<!-- " . $part1 . $part2 . " -->";
    }
}
?>