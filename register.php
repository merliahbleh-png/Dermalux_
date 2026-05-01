<?php
session_start();
require_once "config.php";

if (!$conn) {
    die("Database non disponibile.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($email === "" || $password === "") {
        $message = "Inserisci email e password.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        }

        $message = "Errore registrazione. Email già usata.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione - Dermalux</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/navbar.php"; ?>

<main class="auth-page">
    <h1>Crea account</h1>
    <p>Registrati su Dermalux.</p>

    <?php if ($message): ?>
        <p class="error"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" class="auth-form">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Registrati</button>
    </form>

    <p>Hai già un account? <a href="login.php">Accedi</a></p>
</main>

</body>
</html>
