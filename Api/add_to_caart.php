<?php
session_start();
header('Content-Type: application/json');

$pdo = new PDO("mysql:host=localhost;dbname=electro_store", "root", "");

// Assume user is logged in (or use session user_id = 1 for demo)
$user_id = 1;

$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity'] ?? 1);

// Check if already exists
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
$stmt->execute([$user_id, $product_id]);
$item = $stmt->fetch();

if ($item) {
    $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id=? AND product_id=?");
    $stmt->execute([$quantity, $user_id, $product_id]);
} else {
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?,?,?)");
    $stmt->execute([$user_id, $product_id, $quantity]);
}

echo json_encode(["success" => true]);
