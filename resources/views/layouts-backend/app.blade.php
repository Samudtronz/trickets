<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trickets Admin - Konferensi</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets-backend/images/logo/trickets-logo-only.png') }}">

    <!-- ==================== CSS ORDER ==================== -->

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="{{ asset('assets-backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-backend/css/fontawesome-all.min.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Project Default CSS -->
    <link rel="stylesheet" href="{{ asset('assets-backend/css/main.css') }}">

    <!--  Custom CSS terakhir supaya override -->
    <link rel="stylesheet" href="{{ asset('assets-backend/css/custom.css') }}">

</head>
<body>

@include('partials-backend.preloader')

<section class="dashboard">
    <div class="dashboard__inner d-flex">
        @include('partials-backend.sidebar')
        <div class="dashboard-body">
            @include('partials-backend.dashboard-nav')
            <div class="dashboard-body__content">
                @yield('content')
            </div>
            @include('partials-backend.footer') 
        </div>
    </div>
</section>

<!-- ==================== JAVASCRIPT ORDER ==================== -->
<!-- jQuery (wajib paling pertama) -->
<script src="{{ asset('assets-backend/js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap Bundle (sudah include Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Slick Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<!-- CounterUp2 -->
<script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/lang/toastr.id.min.js"></script>

<!-- Main Custom Script -->
<script src="{{ asset('assets-backend/js/main.js') }}"></script>


@push('scripts')
<script>
$(document).ready(function() {
    @if(session('success'))
        toastr.success("{{ session('success') }}", "Sukses", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
            positionClass: "toast-top-right"
        });
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}", "Gagal", {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
            positionClass: "toast-top-right"
        });
    @endif
});
</script>
@endpush

@stack('scripts')
</body>
</html>