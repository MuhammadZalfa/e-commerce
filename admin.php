<?php
// Inisialisasi variabel $isLoggedIn
session_start();
$isLoggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopKu - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar-brand,
    .text-primary {
      color: #CF95A7 !important;
    }

    .btn-primary {
      background-color: #CF95A7 !important;
      border: none;
    }

    .nav-link:hover {
      transition: color 0.3s ease-in;
      color: #E8A8BC;
    }

    p {
      font-size: 18px;
    }

    .btn-primary:hover {
      transition: background-color .3s ease-in;
      background-color: #E8A8BC !important;
    }

    .blue-bg {
      background-color: #CF95A7;
      color: #fff;
    }

    .features-section {
      background-color: #f9f9f9;
    }

    .card {
      border: none;
      border-radius: 10px;
    }

    .card h3 {
      font-size: 1.25em;
      margin-bottom: 15px;
      color: #333;
    }

    .card-text {
      color: #555;
    }

    .gambar {
      margin-right: 10px;
    }

    @media (max-width: 768px) {
      #userSection {
        display: none;
      }
      #logoutButton {
        display: block;
      }
      
  .wave1{
    width: 105%;
  }
  .wave2{
    width: 105%;
  }
    }

    #logoutButton {
      display: none;
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
            <a class="nav-link" aria-current="page" href="#">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#products">Produk</a>
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

<div class="container">
  <div class="row align-items-center py-4 g-5">
    <div class="col-12 col-md-6">
      <div class="text-center text-md-start">
        <h1 class="display-md-2 display-4 fw-bold text-dark pb-2">
          Selamat Datang <br><span class="text-primary">Admin </span>
        </h1>
        <p class="lead">
          Tambahkan produk dan hapus produk
        </p>
        <a href="add_product.php" class="btn btn-primary mb-3">Add New Product</a>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <img src="assets/admin.png" class="img-fluid" alt="seorang pria menggunakan gadget" />
    </div>
  </div>
</div>
<svg style="margin-top: -100px; filter: drop-shadow(0px -2px 2px rgba(0,0,0,0.1));" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#CF95A7" fill-opacity="1" d="M0,192L34.3,165.3C68.6,139,137,85,206,74.7C274.3,64,343,96,411,133.3C480,171,549,213,617,192C685.7,171,754,85,823,74.7C891.4,64,960,128,1029,160C1097.1,192,1166,192,1234,208C1302.9,224,1371,256,1406,272L1440,288L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
</svg>
<svg style="margin-top: -30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#CF95A7" fill-opacity="1" d="M0,192L34.3,165.3C68.6,139,137,85,206,74.7C274.3,64,343,96,411,133.3C480,171,549,213,617,192C685.7,171,754,85,823,74.7C891.4,64,960,128,1029,160C1097.1,192,1166,192,1234,208C1302.9,224,1371,256,1406,272L1440,288L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
</svg>
<main class="container mt-4"  id="products">
    <h1 class="text-center text-primary mb-5">Product List</h1></h1>
  <div class="row" style="min-height: 400px;">
    <style>
      .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s;
        width: 100%;
      }
      .product-card:hover {
        transform: scale(1.05);
      }
      .product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
      }
      .product-body {
        padding: 15px;
      }
      .product-title {
        font-size: 1.2em;
        margin-bottom: 10px;
        color: #333;
      }
      .product-price {
        font-size: 1.1em;
        color: #E74C3C;
        margin-bottom: 10px;
      }
      .product-description {
        font-size: 0.9em;
        color: #777;
        margin-bottom: 15px;
      }
      .product-buttons {
        text-align: center;
      }
      .btn-wishlist {
        background-color: #CF95A7;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        display: inline-block;
        margin-top: 10px;
      }
      .btn-wishlist:hover {
        background-color: #E8A8BC;
      }
      .col-md-3 {
        margin-bottom: 30px; /* Add margin-bottom to create space between rows */
      }
    </style>
        <?php
    include 'db.php';

    $id = $_GET['id'] ?? null;
    $sql = "SELECT id, name, description, price, image FROM products";
    if ($id) {
      $sql .= " WHERE id = $id";
    }
    $result = $conn->query($sql);

    if ($result === FALSE) {
      echo "Error: " . $conn->error;
    } else if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<div class='col-md-3'>";
        echo "<div class='product-card'>";
        echo "<img src='uploads/" . $row["image"] . "' class='product-img' alt='" . $row["name"] . "'>";
        echo "<div class='product-body'>";
        echo "<h5 class='product-title'>" . $row["name"] . "</h5>";
        echo "<p class='product-price'>Rp" . number_format($row["price"], 0, '', '.') . "</p>";
        echo "<p class='product-description'>" . htmlspecialchars($row["description"]) . "</p>";
        
        echo "<div class='product-buttons'>";
        echo "<form method='POST' action='add_to_wishlist.php'";
        if (!$isLoggedIn) {
            echo " style='display: none;'";
        }
        echo ">";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "</form>";
        echo "<a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>";
        echo "<a href='delete_product_logic.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";
        echo "</div>";

        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "No products found.<br>";
    }

    $conn->close();
    ?>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        if (form) {
            const submitButton = form
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.addEventListener('click', function() {
                form.submit();
            });
        }
    });
</script>

</body>
</html>


