<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login SIKEBAYA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/favicon.png'); ?>">

  <style>
    body {
      background-image: url("<?= base_url('assets/backround.jpg'); ?>");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      margin: 0;
      position: relative;
      overflow: hidden;
      font-family: 'Segoe UI', sans-serif;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      backdrop-filter: blur(7px);
      background-color: rgba(255, 255, 255, 0.15);
      z-index: 0;
    }

    .corner-logo {
      position: absolute;
      height: 80px;
      width: auto;
      z-index: 2;
    }

    .logo-left {
      top: 15px;
      left: 20px;
    }

    .logo-right {
      top: 15px;
      right: 20px;
    }

    .login-container {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      padding: 0 20px;
      text-align: center;
    }

    .login-box {
      background-color: rgba(243, 236, 236, 0.91);
      padding: 35px 30px;
      border-radius: 15px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.25);
    }

    .maskot-img {
      height: 95px;
      margin-bottom: 10px;
    }

    .system-title {
      font-weight: 700;
      font-size: 22px;
      color: #DAA520;
    }

    .sub-title {
      color: rgb(255, 255, 255);
      text-shadow: 1px 1px 2px rgba(17, 16, 13, 0.6);
      margin-bottom: 20px;
      font-size: 14px;
    }

    .login-box input {
      height: 44px;
      padding-left: 15px !important;
    }

    .btn-primary {
      background-color: #1E3A8A;
      border-color: #1E3A8A;
    }

    .btn-primary:hover {
      background-color: #163069;
    }

    .footer {
      margin-top: 18px;
      font-size: 12px;
      color: #555;
    }

    a {
      font-size: 13px;
      color: #DAA520;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 576px) {
      .maskot-img {
        height: 70px;
      }
      .login-box {
        padding: 25px 20px;
      }
      .corner-logo {
        height: 65px;
      }
    }
  </style>
</head>
<body>

  <!-- Logo kiri & kanan -->
  <img src="<?= base_url('assets/polda.png'); ?>" alt="Logo Kiri" class="corner-logo logo-left">
  <img src="<?= base_url('assets/logo1.png'); ?>" alt="Logo Kanan" class="corner-logo logo-right">

  <div class="login-container">
    <img src="<?= base_url('assets/Maskot.png'); ?>" alt="Maskot" class="maskot-img">
    <div class="system-title">SIKEBAYA</div>
    <div class="sub-title">Sistem Informasi Kepegawaian Bhayangkara</div>

    <div class="login-box">
      <h5 class="mb-3 font-weight-bold">Login dengan NIP / ID</h5>
      <?= $this->session->flashdata('pesan'); ?>

      <form action="<?= base_url('welcome'); ?>" method="post">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="NIP / ID">
          <?= form_error('username', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>

      <div class="mt-3">
        <a href="#">Lupa password ?</a>
      </div>
      <div class="footer">
        2025 &copy; IT RS BHAYANGKARA
      </div>
    </div>
  </div>

</body>
</html>
