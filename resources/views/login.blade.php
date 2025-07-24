<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
  <title>Login &mdash; </title>

  <!-- Bootstrap & Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: url('../assets/img/backgrounds/a6d5462b848a895d5552f2b3d4a27ec5.jpg') repeat;
      background-size: cover;
      animation: moveBackground 40s linear infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }

    @keyframes moveBackground {
      0% {
        background-position: 0 0;
      }

      100% {
        background-position: -300px -300px;
      }
    }

    .login-wrapper {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
      backdrop-filter: blur(15px);
      padding: 40px;
      border-radius: 20px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      color: #fff;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }

    .login-wrapper img {
      width: 90px;
      border-radius: 50%;
      margin-bottom: 20px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.6);
    }

    .login-wrapper h4 {
      font-weight: 600;
      margin-bottom: 5px;
    }

    .login-wrapper p {
      font-size: 0.9rem;
      color: #ddd;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 12px;
      background-color: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus {
      border-color: #2980b9;
      box-shadow: 0 0 5px rgba(41, 128, 185, 0.6);
    }

    .input-group-text {
      background-color: #3498db;
      color: #fff;
      border-radius: 12px 0 0 12px;
    }

    .btn-primary {
      background-color: #3498db;
      border: none;
      border-radius: 12px;
      padding: 10px;
      font-weight: bold;
      transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
      background-color: #2c80b3;
      transform: scale(1.03);
    }

    .alert {
      font-size: 0.85rem;
    }

    .footer-text {
      margin-top: 25px;
      font-size: 0.8rem;
      color: #f1f1f1;
    }

    @media (max-width: 480px) {
      .login-wrapper {
        padding: 30px 20px;
      }

      .login-wrapper img {
        width: 75px;
      }
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <img src="../assets/img/backgrounds/" alt=" Logo">
    <h4>Login</h4>
    <p>Selamat Datang di <strong>Pelalawan Pet Shop </strong></p>
    <p>Silakan masuk ke akun Anda</p>

    @if ($errors->any())
    <div class="alert alert-danger text-start">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
      </div>
      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Masuk</button>
      </div>
    </form>

    <div class="footer-text">
      &copy; 2025 ??? — Dibuat dengan ❤️ oleh Tim Pengembang
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
