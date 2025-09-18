<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trickets - Temukan Tiket Event Favoritmu</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo-only.png') }}">


    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#F26417',
                            600: '#D45A14',
                            700: '#B64F12'
                        }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900 font-sans">

    {{-- Preloader --}}
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @yield('footer')
    @includeWhen(View::exists('partials.footer'), 'partials.footer')

    <script>
        // Preloader fade out
        window.addEventListener('load', () => {
            document.querySelector('.loader-mask').style.display = 'none';
        });
    </script>
</body>

</html>
