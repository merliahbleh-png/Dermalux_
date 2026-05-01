<?php include "config.php"; ?>
<link rel="stylesheet" href="assets/css/style.css">
<div class="auth-page">
    <div class="auth-card">
        <a class="brand auth-brand" href="index.php">DERMALUX</a>
        <h1>Create account</h1>
        <p class="auth-subtitle">Start your skincare routine with a premium-looking storefront.</p>

        <form method="POST" class="auth-form">
            <input name="username" type="text" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
            <button class="btn btn-dark full">Register</button>
        </form>

        <p class="auth-switch">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>
<?php
if ($_POST) {
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users(username,password) VALUES (?,?)");
    $stmt->bind_param("ss", $u, $p);
    $stmt->execute();
    header("Location: login.php");
    exit();
}
?>