<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $registrationError = "Username already exists";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $registrationError = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
            .navbar-brand,
    .text-primary {
      color: #CF95A7 !important;
    }

        .text-primary{
            color: #CF95A7 !important;
        }
        .btn-primary {
            background-color: #CF95A7 !important;
            border: none;
        }
        .btn-primary:hover {
            transition: background-color .3s ease-in;
            background-color: #E8A8BC !;
        }
    </style>
</head>
<body>
    <header>
  <nav class="navbar navbar-expand-lg py-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">ShopKu</a>
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
            <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
          </li>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Daftar</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
    <main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/Login.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title text-center mb-4">Register</h5>
                            <form action="register.php" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                                </div>
                                <p>Sudah punya akun? <a href="login.php">Login</a></p>
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                                <?php if(isset($registrationError)): ?>
                                    <div class="alert alert-danger mt-3" role="alert">
                                        <?php echo $registrationError; ?>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
