<?php
session_start();

// Inisialisasi variabel $isLoggedIn
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
        <h1 class="mb-5 text-center">Tambah Produk Baru</h1>
        <div class="row g-3">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <form action="add_product_logic.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk:</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga Produk:</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Produk:</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Tambahkan Produk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
