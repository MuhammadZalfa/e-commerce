<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
session_start();
include 'db.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

if (!empty($image) && !empty($tmp_name)) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    if (move_uploaded_file($tmp_name, $target_file)) {
        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            echo "Produk baru berhasil ditambahkan.<br>";
            header("Location: admin.php");
            exit();
        } else {
            echo "Kesalahan: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gagal meng-upload gambar.<br>";
    }
} else {
    echo "Nama gambar atau nama sementara kosong.<br>";
}

$conn->close();
?>


