<?php
$conn = null;
mysqli_report(MYSQLI_REPORT_OFF);

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT") ?: 3306;

if (!$host && getenv("MYSQL_URL")) {
    $url = parse_url(getenv("MYSQL_URL"));

    $host = $url["host"] ?? null;
    $user = $url["user"] ?? null;
    $pass = $url["pass"] ?? null;
    $port = $url["port"] ?? 3306;
    $db   = isset($url["path"]) ? ltrim($url["path"], "/") : null;
}

if ($host && $user && $db) {
    $conn = @new mysqli($host, $user, $pass, $db, (int)$port);

    if ($conn->connect_error) {
        die("Errore DB: " . $conn->connect_error);
    }
} else {
    die("Variabili DB mancanti. Controlla MYSQLHOST/MYSQL_URL su Railway.");
}
?>
