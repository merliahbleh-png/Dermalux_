<?php
declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_OFF);
$conn = null;

$DB_HOST = getenv('MYSQLHOST') ?: '';
$DB_USER = getenv('MYSQLUSER') ?: '';
$DB_PASS = getenv('MYSQLPASSWORD') ?: '';
$DB_NAME = getenv('MYSQLDATABASE') ?: '';
$DB_PORT = (int)(getenv('MYSQLPORT') ?: 3306);

if ($DB_HOST !== '' && $DB_USER !== '' && $DB_NAME !== '') {
    $conn = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
    if ($conn && !$conn->connect_error) {
        $conn->set_charset('utf8mb4');
        $conn->query("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    } else {
        $conn = null;
    }
}

function db_available(): bool {
    global $conn;
    return $conn instanceof mysqli;
}

function dermalux_products(): array {
    return [
        1 => ['id'=>1,'name'=>'Hydra Glow Serum','description'=>'Lightweight hydrating serum for luminous everyday skin.','price'=>39.90,'image'=>'assets/img/1.svg'],
        2 => ['id'=>2,'name'=>'Barrier Repair Cream','description'=>'Rich daily cream designed to support a soft skin barrier.','price'=>44.90,'image'=>'assets/img/2.svg'],
        3 => ['id'=>3,'name'=>'Vitamin Radiance Oil','description'=>'Silky facial oil for a polished, healthy-looking glow.','price'=>34.90,'image'=>'assets/img/3.svg'],
        4 => ['id'=>4,'name'=>'Gentle Foam Cleanser','description'=>'Fresh cleanser for a clean, balanced routine.','price'=>24.90,'image'=>'assets/img/4.svg'],
    ];
}
function dermalux_get_product(int $id): array {
    $p = dermalux_products();
    return $p[$id] ?? $p[1];
}
function current_flag(): string { return 'FLAG{cookie_handler_v2}'; }
function cookie_reveals_flag(): bool {
    if (empty($_COOKIE['DLX_SESSION'])) return false;
    $decoded = base64_decode((string)$_COOKIE['DLX_SESSION'], true);
    return $decoded !== false && stripos($decoded, 'admin') !== false;
}
?>