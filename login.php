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
            $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
            if (!$stmt) { $message = "Errore database: tabella users non disponibile."; }
            else {
                $stmt->bind_param("s", $email); $stmt->execute(); $result = $stmt->get_result();
                if ($result && $result->num_rows === 1) {
                    $user = $result->fetch_assoc();
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user_id"] = $user["id"]; $_SESSION["email"] = $user["email"];
                        header("Location: index.php"); exit;
                    }
                }
                $message = "Credenziali non valide."; $stmt->close();
            }
        }
    }
}
include "includes/navbar.php";
?>
<main class="auth-page"><h1>Account</h1><p>Accedi al tuo account Dermalux.</p><?php if (!db_available()): ?><p class="notice">Il login richiede MySQL. Il resto del sito funziona anche senza database.</p><?php endif; ?><?php if ($message): ?><p class="error"><?php echo htmlspecialchars($message); ?></p><?php endif; ?><form method="POST" class="auth-form"><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button type="submit" class="btn btn-dark full">Accedi</button></form><p>Non hai un account? <a href="register.php">Registrati</a></p></main>
<script src="assets/js/app.js"></script>
<?php include "includes/footer.php"; ?>