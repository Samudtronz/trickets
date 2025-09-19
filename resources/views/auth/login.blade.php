<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    body { height: 100vh; }
    .login-card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      padding: 30px;
      background: #fff;
      transition: transform 0.2s ease-in-out;
    }
    .login-card:hover { transform: translateY(-5px); }
    .login-title { font-weight:700; font-size:1.6rem; }
    .form-control { border-radius:12px; padding:12px; }
    .btn-login { border-radius:12px; padding:12px; font-weight:600; font-size:1rem; }
    .password-wrapper { position:relative; }
    .toggle-password { position:absolute; top:50%; right:12px; transform:translateY(-50%); cursor:pointer; color:#6c757d; }
  </style>
</head>
<body class="bg-light d-flex align-items-center">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
      <div class="login-card">
        <div class="text-center mb-4">
          <i class="fa-solid fa-circle-user fa-3x text-primary mb-2"></i>
          <h3 class="login-title text-primary">Login</h3>
        </div>

        {{-- Error dari session --}}
        @if(session('error'))
          <div class="alert alert-danger py-2 px-3">{{ session('error') }}</div>
        @endif
        @if(session('success'))
          <div class="alert alert-success py-2 px-3">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
          @csrf
          {{-- Email --}}
          <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
          </div>

          {{-- Password --}}
          <div class="mb-4 password-wrapper">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
            <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
          </div>

          <button class="btn btn-primary w-100 btn-login">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Login
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  togglePassword.addEventListener("click", function () {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
  });
</script>

</body>
</html>
