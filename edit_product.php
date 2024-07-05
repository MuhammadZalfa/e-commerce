<?php

session_start();

// Inisialisasi variabel $isLoggedIn
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : null;



include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name='$name', description='$description', price=$price WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand,
    .text-primary {
      color: #CF95A7 !important; /* Mengubah warna teks utama menjadi warna yang lebih mencolok */
    }
        .btn-primary {
            background-color: #CF95A7 !important;
            border: none;
        }

        .btn-primary:hover {
            transition: background-color .3s ease-in;
            background-color: #E8A8BC !important;
        }
    </style>
</head>
<body>
    <header>
  <nav class="navbar navbar-expand-lg py-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="admin.php">ShopKu</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="admin.php">Beranda</a>
          </li>
          </li>
          <?php if ($isLoggedIn): ?>
            <li class="nav-item dropdown d-none d-lg-block" id="userSection">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/User.png" alt="profile" class="img-fluid rounded-circle" style="width: 30px; height: 30px;">
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href=""><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
              </ul>
            </li>
            <li class="nav-item d-block d-lg-none" id="logoutButton">
              <a class="nav-link" href="logout.php">Keluar</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Daftar</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

    <main class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Edit Product</h1>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?php echo $product['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control form-control-lg" id="description" name="description" rows="3"><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control form-control-lg" id="price" name="price" value="<?php echo $product['price']; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </main>
