<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $confirm = isset($_GET['confirm']) && $_GET['confirm'] == 'true';
    if ($confirm) {
        try {
            $conn->begin_transaction();
            $sql = "DELETE FROM wishlists WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $conn->commit();
            header("Location: admin.php");
        } catch (mysqli_sql_exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>if(!confirm('Are you sure you want to delete this product?')){window.location.href='admin.php'}else{window.location.href='delete_product_logic.php?id=$id&delete=true&confirm=true'}</script>";
    }
} else {
    echo "<script>window.location.href='delete_product_logic.php?id=$id&delete=true'</script>";
}

$conn->close();

