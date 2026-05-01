<?php
$conn = null;
mysqli_report(MYSQLI_REPORT_OFF);

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT") ?: 3306;

if ($host && $user && $db) {
    $conn = @new mysqli($host, $user, $pass, $db, (int)$port);

    if ($conn->connect_error) {
        $conn = null;
    }
}
?>
