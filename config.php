<?php
// Dermalux config - Railway safe version
// The site stays online even if MySQL is not configured or unavailable.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_connected = false;
$conn = null;
$db_error = null;

$host = getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: '';
$port = getenv('MYSQLPORT') ?: getenv('DB_PORT') ?: '3306';
$user = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: '';
$pass = getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: '';
$db   = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: '';

if ($host && $user && $db) {
    mysqli_report(MYSQLI_REPORT_OFF);
    $tmp = @new mysqli($host, $user, $pass, $db, (int)$port);
    if (!$tmp->connect_error) {
        $conn = $tmp;
        $db_connected = true;
        $conn->set_charset('utf8mb4');
    } else {
        $db_error = $tmp->connect_error;
    }
} else {
    $db_error = 'Database variables not configured. Site is running with fallback demo data.';
}

function db_is_connected() {
    global $db_connected;
    return $db_connected === true;
}

function dermalux_fallback_products() {
    return [
        ['id'=>1, 'name'=>'Hydra Glow Serum', 'description'=>'Lightweight hydrating serum for luminous everyday skin.', 'price'=>39.90],
        ['id'=>2, 'name'=>'Barrier Repair Cream', 'description'=>'Rich daily cream designed to support a soft skin barrier.', 'price'=>44.90],
        ['id'=>3, 'name'=>'Vitamin Radiance Oil', 'description'=>'Silky facial oil for a polished, healthy-looking glow.', 'price'=>34.90],
        ['id'=>4, 'name'=>'Gentle Foam Cleanser', 'description'=>'Fresh cleanser for a clean, balanced routine.', 'price'=>24.90],
        ['id'=>5, 'name'=>'Night Renewal Mask', 'description'=>'Overnight hydration mask with a premium spa texture.', 'price'=>49.90],
        ['id'=>6, 'name'=>'Daily Mineral SPF', 'description'=>'Everyday mineral protection with a soft finish.', 'price'=>29.90],
        ['id'=>7, 'name'=>'Eye Recovery Gel', 'description'=>'Cooling eye gel for a fresh morning routine.', 'price'=>27.90],
        ['id'=>8, 'name'=>'Smooth Body Lotion', 'description'=>'Clean body hydration with a minimal luxury feel.', 'price'=>31.90],
    ];
}

function dermalux_get_products($limit = null) {
    global $conn;
    $products = [];
    if (db_is_connected()) {
        $sql = 'SELECT * FROM products ORDER BY id ASC';
        if ($limit !== null) { $sql .= ' LIMIT ' . intval($limit); }
        $res = @$conn->query($sql);
        if ($res) {
            while ($row = $res->fetch_assoc()) { $products[] = $row; }
        }
    }
    if (!$products) {
        $products = dermalux_fallback_products();
        if ($limit !== null) { $products = array_slice($products, 0, intval($limit)); }
    }
    return $products;
}

function dermalux_get_product($id) {
    global $conn;
    $id = max(1, intval($id));
    if (db_is_connected()) {
        $res = @$conn->query('SELECT * FROM products WHERE id = ' . $id . ' LIMIT 1');
        if ($res) {
            $row = $res->fetch_assoc();
            if ($row) { return $row; }
        }
    }
    foreach (dermalux_fallback_products() as $p) {
        if ((int)$p['id'] === $id) { return $p; }
    }
    return dermalux_fallback_products()[0];
}
?>
