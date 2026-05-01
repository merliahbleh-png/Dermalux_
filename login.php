<?php
require_once "config.php";

if (!$conn) {
    die("Database non disponibile. Controlla le variabili MySQL su Railway.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($email === "" || $password === "") {
        $message = "Inserisci email e password.";
    } else {
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["email"] = $user["email"];

                header("Location: index.php");
                exit;
            } else {
                $message = "Credenziali non valide.";
            }
        } else {
            $message = "Credenziali non valide.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - Dermalux</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php
if (file_exists("includes/navbar.php")) {
    include "includes/navbar.php";
}
?>

<main class="auth-page">
    <h1>Account</h1>
    <p>Accedi al tuo account Dermalux.</p>

    <?php if ($message): ?>
        <p class="error"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" class="auth-form">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Accedi</button>
    </form>

    <p>Non hai un account? <a href="register.php">Registrati</a></p>
</main>

</body>
</html>
