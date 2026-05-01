CREATE DATABASE IF NOT EXISTS dermalux;
USE dermalux;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2)
);

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT
);

CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note TEXT
);

DELETE FROM products;
INSERT INTO products (id, name, description, price) VALUES
(1, 'HydraGlow Serum', 'Deep hydration serum with a silky finish and premium texture.', 39.99),
(2, 'PureClean Cleanser', 'Gentle daily cleanser for a soft, balanced skin barrier.', 19.99),
(3, 'Night Repair Cream', 'Rich overnight cream designed for a smoother morning finish.', 49.99),
(4, 'Vitamin C Booster', 'Brightening booster for a more even, radiant complexion.', 34.99),
(5, 'Barrier Restore Toner', 'Balancing toner made to support a calm, resilient skin barrier.', 24.99),
(6, 'Daily SPF Veil', 'Lightweight daily sunscreen with a comfortable invisible finish.', 29.99),
(7, 'Peptide Eye Cream', 'Smoothing eye cream for a softer and more rested look.', 32.99),
(8, 'Overnight Renewal Mask', 'Cushiony sleeping mask for overnight hydration and glow.', 44.99);

CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note TEXT
);

DELETE FROM logs;
INSERT INTO logs (note) VALUES ('Backup key stored in legacy system - ref: cookie_handler_v2');
