<?php
session_start();
require_once "config.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!db_available()) { $message = "Database non disponibile. Controlla le variabili MySQL su Railway."; }
    else {
        $email = trim($_POST["email"] ?? ""); $password = trim($_POST["password"] ?? "");
        if ($email === "" || $password === "") { $message = "Inserisci email e password."; }
        else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            if (!$stmt) { $message = "Errore database: tabella users non disponibile."; }
            else {
                $stmt->bind_param("ss", $email, $hashedPassword);
                if ($stmt->execute()) { header("Location: login.php"); exit; }
                else { $message = "Errore registrazione. Email già usata."; }
                $stmt->close();
            }
        }
    }
}
include "includes/navbar.php";
?>
<main class="auth-page"><h1>Crea account</h1><p>Registrati su Dermalux.</p><?php if (!db_available()): ?><p class="notice">La registrazione richiede MySQL. Il resto del sito funziona anche senza database.</p><?php endif; ?><?php if ($message): ?><p class="error"><?php echo htmlspecialchars($message); ?></p><?php endif; ?><form method="POST" class="auth-form"><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button type="submit" class="btn btn-dark full">Registrati</button></form><p>Hai già un account? <a href="login.php">Accedi</a></p></main>
<script src="assets/js/app.js"></script>
<?php include "includes/footer.php"; ?>