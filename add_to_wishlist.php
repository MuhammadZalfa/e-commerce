<?php

session_start();

include 'db.php';

$isLoggedIn = isset($_SESSION['username']);

if (!$isLoggedIn) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['add_to_wishlist'])) {
    $productId = $_POST['product_id'] ?? null;
    $userId = $_SESSION['userId'] ?? null;

    if ($productId && $userId) {
        $sql = "SELECT * FROM wishlists WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Produk sudah ada di wishlist.";
        } else {
            $sql = "INSERT INTO wishlists (user_id, product_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $userId, $productId);

            if ($stmt->execute()) {
                echo "Produk berhasil ditambahkan ke wishlist.";
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "ID produk atau ID pengguna tidak ditemukan.";
    }
}

?>

