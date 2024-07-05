<?php
session_start();

include 'db.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Dapatkan userId dari sesi pengguna
$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$userId = null;

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $userId = $user['id'];
}

$stmt->close();

// Dapatkan id produk yang dihapus dari query string
$productId = $_GET['product_id'] ?? null;

// Periksa apakah id produk dan userId valid
if ($productId && $userId) {
    $sql = "DELETE FROM wishlists WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();

    // Redirect ke halaman wishlist
    header("Location: wishlist.php");
    exit;
} else {
    echo "ID produk atau ID pengguna tidak ditemukan.";
}

$conn->close();
?>
