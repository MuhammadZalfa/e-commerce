<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .navbar-brand,
    .text-primary {
      color: #CF95A7 !important; /* Mengubah warna teks utama menjadi warna yang lebih mencolok */
    } 
    </style>
</head>
<body>
    <?php
    include 'db.php';

    // Pastikan pengguna sudah login
    if (!$isLoggedIn) {
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
    ?>
    <header>
  <nav class="navbar navbar-expand-lg py-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">ShopKu</a>
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
          <li class="nav-item ms-0 ms-md-3">
            <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
          </li>
          <li class="nav-item ms-0 ms-md-3">
            <a class="nav-link" href="index.php=#products">Produk</a>
          </li>
          <li class="nav-item ms-0 ms-md-3">
            <a class="nav-link" href="index.php=#about">Tentang</a>
          </li>
          <li class="nav-item ms-0 ms-md-3">
            <a class="nav-link" href="wishlist.php">Wishlist</a>
          </li>
          <?php if ($isLoggedIn): ?>
            <li class="nav-item dropdown ms-0 ms-md-3">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/User.png" alt="profile" class="img-fluid rounded-circle me-2" style="width: 30px; height: 30px;">
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href=""><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

    <main class="container mt-5">
    <h1>My Wishlist</h1>
    <div class="row">
        <style>
            .product-card {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                overflow: hidden;
                margin: 15px;
                transition: transform 0.2s;
                width: 18rem;
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
            .btn-danger {
                background-color: #E74C3C;
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                display: inline-block;
                margin-top: 10px;
            }
            .btn-danger:hover {
                background-color: #C0392B;
            }
        </style>

        <?php
        if ($userId) {
            $sql = "SELECT p.* FROM wishlists AS w
                    JOIN products AS p ON w.product_id = p.id
                    WHERE w.user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

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
        echo "<a href='remove_from_wishlist.php?product_id=" . $row["id"] . "' class='btn-danger'>Remove</a>";
        echo "</form>";
        echo "</div>";

        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "No products found.<br>";
    }

    $conn->close();
    }
    ?>
    </div>
</main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

