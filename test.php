<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if (!empty($image) && !empty($tmp_name)) {
        if (move_uploaded_file($tmp_name, "uploads/$image")) {
            echo "Gambar berhasil di-upload.<br>";
        } else {
            echo "Gagal meng-upload gambar.<br>";
            var_dump($_FILES['image']);
        }
    } else {
        echo "Nama gambar atau nama sementara kosong.<br>";
        var_dump($_FILES['image']);
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit">Upload</button>
</form>
