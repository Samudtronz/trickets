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
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-8 text-center text-gray-900">Edit Konten Frontend</h2>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

    <form action="{{ route('backend.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- WELCOME --}}
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-4">Welcome</h2>

                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul (home_title)</label>
                        <input type="text" name="title" value="{{ old('title', $konten['home_title'] ?? '') }}" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline (home_tagline)</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $konten['home_tagline'] ?? '') }}" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (home_description)</label>
                        <textarea name="description" rows="4" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $konten['home_description'] ?? '') }}</textarea>
                    </div>

                    {{-- Upload Background --}}
                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Background</label>
                        <div class="mb-2 flex justify-center">
                            <img id="previewBackground"
                                src="{{ old('background_preview') ? old('background_preview') : (!empty($konten['home_background']) ? Storage::url($konten['home_background']) : asset('assets/images/backgrounds/no-images.png')) }}"
                                alt="Background" class="h-32 w-full object-cover rounded-lg border border-gray-300 shadow-md">
                        </div>
                        <input type="file" name="home_background" id="backgroundInput"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" accept="image/*">
                        <input type="hidden" name="background_preview" id="backgroundPreviewHidden" value="{{ old('background_preview') }}">
                    </div>

                    {{-- Upload Logo --}}
                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                        <div class="mb-2 flex justify-center">
                            <img id="previewLogo"
                                src="{{ old('logo_preview') ? old('logo_preview') : (!empty($konten['home_logo']) ? Storage::url($konten['home_logo']) : asset('assets/images/logo/no-images.png')) }}"
                                alt="Logo" class="h-32 w-32 object-contain rounded-lg border border-gray-300 shadow-md">
                        </div>
                        <input type="file" name="home_logo" id="logoInput"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" accept="image/*">
                        <input type="hidden" name="logo_preview" id="logoPreviewHidden" value="{{ old('logo_preview') }}">
                    </div>
                </div>

        {{-- CONFERENCE (Trending + Show) --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Trending Konferensi & Show</h2>

            {{-- Trending Conference --}}
            <h3 class="font-semibold mb-2">Trending Konferensi</h3>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Teks EVENT TRENDING</label>
                <input type="text" name="conference_event_trending_text"
                    value="{{ old('conference_event_trending_text', $konten['conference_event_trending_text'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Trending Konferensi</label>
                <input type="text" name="trending_conference_title"
                    value="{{ old('trending_conference_title', $konten['trending_conference_title'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-4 gap-2 mt-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">HARI</label>
                    <input type="text" name="trending_conference_countdown_hari"
                        value="{{ old('trending_conference_countdown_hari', $konten['trending_conference_countdown_hari'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">JAM</label>
                    <input type="text" name="trending_conference_countdown_jam"
                        value="{{ old('trending_conference_countdown_jam', $konten['trending_conference_countdown_jam'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">MENIT</label>
                    <input type="text" name="trending_conference_countdown_menit"
                        value="{{ old('trending_conference_countdown_menit', $konten['trending_conference_countdown_menit'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">DETIK</label>
                    <input type="text" name="trending_conference_countdown_detik"
                        value="{{ old('trending_conference_countdown_detik', $konten['trending_conference_countdown_detik'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Subjudul Daftar Event Konferensi</label>
                <input type="text" name="conference_event_list"
                    value="{{ old('conference_event_list', $konten['conference_event_list'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            {{-- Show Konferensi --}}
            <h3 class="font-semibold mt-6 mb-2">Show Konferensi</h3>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Sidebar</label>
                <input type="text" name="conference_sidebar_kuota_tanggal_title"
                    value="{{ old('conference_sidebar_kuota_tanggal_title', $konten['conference_sidebar_kuota_tanggal_title'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-2 mt-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label Sisa Kuota</label>
                    <input type="text" name="conference_sidebar_sisa_kuota_label"
                        value="{{ old('conference_sidebar_sisa_kuota_label', $konten['conference_sidebar_sisa_kuota_label'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label Peserta</label>
                    <input type="text" name="conference_sidebar_peserta_label"
                        value="{{ old('conference_sidebar_peserta_label', $konten['conference_sidebar_peserta_label'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Label Tanggal Event</label>
                <input type="text" name="conference_sidebar_tanggal_event_label"
                    value="{{ old('conference_sidebar_tanggal_event_label', $konten['conference_sidebar_tanggal_event_label'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Countdown</label>
                <input type="text" name="conference_countdown_title"
                    value="{{ old('conference_countdown_title', $konten['conference_countdown_title'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-4 gap-2 mt-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                    <input type="text" name="conference_countdown_label_hari"
                        value="{{ old('conference_countdown_label_hari', $konten['conference_countdown_label_hari'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam</label>
                    <input type="text" name="conference_countdown_label_jam"
                        value="{{ old('conference_countdown_label_jam', $konten['conference_countdown_label_jam'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Menit</label>
                    <input type="text" name="conference_countdown_label_menit"
                        value="{{ old('conference_countdown_label_menit', $konten['conference_countdown_label_menit'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detik</label>
                    <input type="text" name="conference_countdown_label_detik"
                        value="{{ old('conference_countdown_label_detik', $konten['conference_countdown_label_detik'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>
        </div>

        {{-- TRENDING MUSICAL --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Trending Musikal</h2>

            {{-- Teks EVENT TRENDING --}}
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Teks EVENT TRENDING</label>
                <input type="text" name="musical_event_trending_text"
                    value="{{ old('musical_event_trending_text', $konten['musical_event_trending_text'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            {{-- Judul Trending Musical --}}
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Trending Musical</label>
                <input type="text" name="trending_musical_title"
                    value="{{ old('trending_musical_title', $konten['trending_musical_title'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            {{-- Countdown --}}
            <div class="grid grid-cols-4 gap-2 mt-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                    <input type="text" name="trending_musical_countdown_hari"
                        value="{{ old('trending_musical_countdown_hari', $konten['trending_musical_countdown_hari'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam</label>
                    <input type="text" name="trending_musical_countdown_jam"
                        value="{{ old('trending_musical_countdown_jam', $konten['trending_musical_countdown_jam'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Menit</label>
                    <input type="text" name="trending_musical_countdown_menit"
                        value="{{ old('trending_musical_countdown_menit', $konten['trending_musical_countdown_menit'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detik</label>
                    <input type="text" name="trending_musical_countdown_detik"
                        value="{{ old('trending_musical_countdown_detik', $konten['trending_musical_countdown_detik'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            {{-- Subjudul Daftar Event Musikal --}}
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Subjudul Daftar Event Musikal</label>
                <input type="text" name="musical_event_list"
                    value="{{ old('musical_event_list', $konten['musical_event_list'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            {{-- Sidebar & Countdown Musical Show --}}
            <h3 class="text-lg font-semibold mt-6 mb-3">Sidebar & Countdown Musical</h3>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kuota & Tanggal</label>
                <input type="text" name="musical_sidebar_kuota_tanggal_title"
                    value="{{ old('musical_sidebar_kuota_tanggal_title', $konten['musical_sidebar_kuota_tanggal_title'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-2 mt-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label Sisa Kuota</label>
                    <input type="text" name="musical_sidebar_sisa_kuota_label"
                        value="{{ old('musical_sidebar_sisa_kuota_label', $konten['musical_sidebar_sisa_kuota_label'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label Peserta</label>
                    <input type="text" name="musical_sidebar_peserta_label"
                        value="{{ old('musical_sidebar_peserta_label', $konten['musical_sidebar_peserta_label'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Label Tanggal Event</label>
                <input type="text" name="musical_sidebar_tanggal_event_label"
                    value="{{ old('musical_sidebar_tanggal_event_label', $konten['musical_sidebar_tanggal_event_label'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Hitung Mundur</label>
                <input type="text" name="musical_countdown_title"
                    value="{{ old('musical_countdown_title', $konten['musical_countdown_title'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-4 gap-2 mt-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                    <input type="text" name="musical_countdown_label_hari"
                        value="{{ old('musical_countdown_label_hari', $konten['musical_countdown_label_hari'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam</label>
                    <input type="text" name="musical_countdown_label_jam"
                        value="{{ old('musical_countdown_label_jam', $konten['musical_countdown_label_jam'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Menit</label>
                    <input type="text" name="musical_countdown_label_menit"
                        value="{{ old('musical_countdown_label_menit', $konten['musical_countdown_label_menit'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detik</label>
                    <input type="text" name="musical_countdown_label_detik"
                        value="{{ old('musical_countdown_label_detik', $konten['musical_countdown_label_detik'] ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>
        </div>

        {{-- NAVBAR --}}
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Navbar</h2>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo Navbar</label>
                @if (!empty($konten['navbar_logo']))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $konten['navbar_logo']) }}" 
                            alt="Navbar Logo" class="h-16">
                    </div>
                @endif
                <input type="file" name="navbar_logo"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Brand</label>
                <input type="text" name="navbar_brand"
                    value="{{ old('navbar_brand', $konten['navbar_brand'] ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        {{-- Upload Footer Logo --}}
        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Footer Logo</label>
            <div class="mb-2 flex justify-center">
                <img id="previewFooterLogo"
                    src="{{ old('footer_logo_preview') ? old('footer_logo_preview') : (!empty($konten['footer_logo']) ? Storage::url($konten['footer_logo']) : asset('assets/images/logo/logo-only.png')) }}"
                    alt="Footer Logo"
                    class="h-32 w-32 object-contain rounded-lg border border-gray-300 shadow-md">
            </div>
            <input type="file" name="footer_logo" id="footerLogoInput"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                accept="image/*">
            <input type="hidden" name="footer_logo_preview" id="footerLogoPreviewHidden" value="{{ old('footer_logo_preview') }}">
        </div>

        {{-- Footer Brand --}}
        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
            <input type="text" name="footer_brand" value="{{ old('footer_brand', $konten['footer_brand'] ?? '') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        {{-- Footer Description --}}
        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="footer_description" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('footer_description', $konten['footer_description'] ?? '') }}</textarea>
        </div>

        {{-- Footer Copyright --}}
        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Copyright</label>
            <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $konten['footer_copyright'] ?? '') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div class="text-center mt-6">
            <button type="submit"
                class="bg-[#F26417] hover:bg-[#e2570e] text-white px-8 py-3 rounded-lg font-semibold shadow-lg transition-colors">
                Simpan
            </button>
        </div>

    </form>

    <script>
        function previewFile(input, previewId, hiddenId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(hiddenId).value = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('backgroundInput').addEventListener('change', function() {
            previewFile(this, 'previewBackground', 'backgroundPreviewHidden');
        });

        document.getElementById('logoInput').addEventListener('change', function() {
            previewFile(this, 'previewLogo', 'logoPreviewHidden');
        });
    </script>

    {{-- Script preview --}}
<script>
    const footerLogoInput = document.getElementById('footerLogoInput');
    const previewFooterLogo = document.getElementById('previewFooterLogo');
    const footerLogoPreviewHidden = document.getElementById('footerLogoPreviewHidden');

    footerLogoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewFooterLogo.src = event.target.result;
                footerLogoPreviewHidden.value = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
@section('footer')
    @include('partials.footer')
@endsection
</html>

