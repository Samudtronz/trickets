<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konten Frontend</title>
    <script src="https://cdn.tailwindcss.com"></script>

        <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo-only.png') }}">

</head>
<body class="bg-gray-100 min-h-screen flex items-start justify-center py-10">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-8 text-center text-gray-900">Edit Konten Frontend</h2>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('backend.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul (home_title)</label>
                <input type="text" name="title" value="{{ old('title', $konten['home_title'] ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Tagline -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tagline (home_tagline)</label>
                <input type="text" name="tagline" value="{{ old('tagline', $konten['home_tagline'] ?? '') }}" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (home_description)</label>
                <textarea name="description" rows="4" 
                          class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $konten['home_description'] ?? '') }}</textarea>
            </div>

            <!-- Upload Background -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Background (home_background)</label>
                <div class="mb-2 flex justify-center">
                  <img id="previewBackground"
                    src="{{ old('background_preview') ? old('background_preview') : (!empty($konten['home_background']) ? Storage::url($konten['home_background']) : asset('assets/images/backgrounds/no-images.png')) }}"
                    alt="Background"
                    class="h-32 w-full object-cover rounded-lg border border-gray-300 shadow-md">
                </div>
                <input type="file" name="background" id="backgroundInput"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    accept="image/*">
                <input type="hidden" name="background_preview" id="backgroundPreviewHidden" value="{{ old('background_preview') }}">
            </div>

            <!-- Upload Logo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo (home_logo)</label>
                <div class="mb-2 flex justify-center">
                    <img id="previewLogo"
                        src="{{ old('logo_preview') ? old('logo_preview') : (!empty($konten['home_logo']) ? Storage::url($konten['home_logo']) : asset('assets/images/logo/no-images.png')) }}"
                        alt="Logo"
                        class="h-32 w-32 object-contain rounded-lg border border-gray-300 shadow-md">
                </div>
                <input type="file" name="logo" id="logoInput"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    accept="image/*">
                <input type="hidden" name="logo_preview" id="logoPreviewHidden" value="{{ old('logo_preview') }}">
            </div>
            
            <div class="text-center">
                <button type="submit" class="bg-[#F26417] hover:bg-[#e2570e] text-white px-8 py-3 rounded-lg font-semibold shadow-lg transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        // Fungsi preview image
        function previewFile(input, previewId, hiddenId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(hiddenId).value = e.target.result; // simpan ke hidden supaya old() tetap ada
                }
                reader.readAsDataURL(file);
            }
        }

        // Event listener untuk background & logo
        document.getElementById('backgroundInput').addEventListener('change', function() {
            previewFile(this, 'previewBackground', 'backgroundPreviewHidden');
        });

        document.getElementById('logoInput').addEventListener('change', function() {
            previewFile(this, 'previewLogo', 'logoPreviewHidden');
        });
    </script>
</body>
@section('footer')
    @include('partials.footer') {{-- footer hanya terpanggil di sini --}}
@endsection
</html>
