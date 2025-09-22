<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Trickets</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets-backend/images/logo/trickets-logo-only.png') }}">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="{{ asset('assets-backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-backend/css/fontawesome-all.min.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets-backend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-backend/css/custom.css') }}">
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0" style="min-height: 100vh;">
        <!-- Login Form Start -->
        <div class="row w-100 justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 shadow-sm my-4 mx-3">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets-backend/images/logo/trickets-logo-only.png') }}" alt="Logo" class="mb-2" width="60">
                        <h3 class="fw-bold text">Trickets Admin-Backend</h3>
                        <p class="text-muted">Silakan login untuk melanjutkan</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan Email">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Login Form End -->
    </div>

    <!-- JS Libraries -->
    <script src="{{ asset('assets-backend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr Notifications -->
    <script>
    $(document).ready(function() {
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Validasi Error', {timeOut: 5000});
            @endforeach
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}', 'Login Gagal', {timeOut: 5000});
        @endif

        @if(session('success'))
            toastr.success('{{ session('success') }}', 'Berhasil', {timeOut: 3000});
        @endif
    });
    </script>
</body>
</html>