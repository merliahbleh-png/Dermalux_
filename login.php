<?php include "config.php"; ?>
<link rel="stylesheet" href="assets/css/style.css">
<div class="auth-page">
    <div class="auth-card">
        <a class="brand auth-brand" href="index.php">DERMALUX</a>
        <h1>Welcome back</h1>
        <p class="auth-subtitle">Access your account to continue shopping.</p>

        <form method="POST" class="auth-form">
            <input name="username" type="text" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
            <button class="btn btn-dark full">Login</button>
        </form>

        <p class="auth-switch">First time here? <a href="register.php">Create an account</a></p>
    </div>
</div>
<?php
if ($_POST) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE username='$u'");
    $user = $res ? $res->fetch_assoc() : null;

    if ($user && password_verify($p, $user['password'])) {
        $_SESSION['user'] = $u;
        $payload = base64_encode(openssl_encrypt("guest:$u", "AES-128-ECB", "d3rma_secret"));
        setcookie("DLX_SESSION", $payload, time()+3600, "/");
        header("Location: index.php");
        exit();
    } else {
        echo "<p class='flash-error'>Login failed</p>";
    }
}
?>