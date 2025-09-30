@extends('layouts-backend.app')

@section('content')
<section class="py-4 bg-light min-vh-100">
    <div class="container">
        <h1 class="h3 fw-bold mb-4 text-center">Edit Konten Halaman Utama</h1>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('backend.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ================= WELCOME ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Welcome</div>
                        <div class="card-body">
                        <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="home_title" class="form-control"
                            value="{{ old('home_title', $konten['home_title'] ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tagline</label>
                        <input type="text" name="home_tagline" class="form-control"
                            value="{{ old('home_tagline', $konten['home_tagline'] ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="home_description" rows="3" class="form-control">{{ old('home_description', $konten['home_description'] ?? '') }}</textarea>
                    </div>
                            {{-- Background --}}
                            <div class="mb-3">
                                <label class="form-label">Background</label>
                                <div class="mb-2 text-center">
                                    <img id="previewBackground"
                                        src="{{ !empty($konten['home_background']) ? asset('storage/'.$konten['home_background']) : asset('assets/images/backgrounds/no-images.png') }}"
                                        alt="Background" class="img-fluid rounded border" style="max-height: 150px;">
                                </div>
                                <input type="file" name="home_background" id="backgroundInput" class="form-control" accept="image/*">
                            </div>

                            {{-- Logo --}}
                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                <div class="mb-2 text-center">
                                    <img id="previewLogo"
                                        src="{{ !empty($konten['home_logo']) ? asset('storage/'.$konten['home_logo']) : asset('assets/images/logo/no-images.png') }}"
                                        alt="Logo" class="img-fluid rounded border" style="max-height: 100px;">
                                </div>
                                <input type="file" name="home_logo" id="logoInput" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>

                    {{-- ================= CONFERENCE ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Trending Konferensi & Show</div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Trending Konferensi</h6>
                            <div class="mb-3">
                                <label class="form-label">Teks EVENT TRENDING</label>
                                <input type="text" name="conference_event_trending_text" class="form-control"
                                    value="{{ old('conference_event_trending_text', $konten['conference_event_trending_text'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Trending Konferensi</label>
                                <input type="text" name="trending_conference_title" class="form-control"
                                    value="{{ old('trending_conference_title', $konten['trending_conference_title'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col"><input type="text" name="trending_conference_countdown_hari" class="form-control mb-2" placeholder="Hari" value="{{ old('trending_conference_countdown_hari', $konten['trending_conference_countdown_hari'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="trending_conference_countdown_jam" class="form-control mb-2" placeholder="Jam" value="{{ old('trending_conference_countdown_jam', $konten['trending_conference_countdown_jam'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="trending_conference_countdown_menit" class="form-control mb-2" placeholder="Menit" value="{{ old('trending_conference_countdown_menit', $konten['trending_conference_countdown_menit'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="trending_conference_countdown_detik" class="form-control mb-2" placeholder="Detik" value="{{ old('trending_conference_countdown_detik', $konten['trending_conference_countdown_detik'] ?? '') }}"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subjudul Daftar Event Konferensi</label>
                                <input type="text" name="conference_event_list" class="form-control"
                                    value="{{ old('conference_event_list', $konten['conference_event_list'] ?? '') }}">
                            </div>

                            <h6 class="fw-bold mt-4 mb-3">Show Konferensi</h6>
                            <div class="mb-3">
                                <label class="form-label">Judul Sidebar</label>
                                <input type="text" name="conference_sidebar_kuota_tanggal_title" class="form-control"
                                    value="{{ old('conference_sidebar_kuota_tanggal_title', $konten['conference_sidebar_kuota_tanggal_title'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col"><input type="text" name="conference_sidebar_sisa_kuota_label" class="form-control mb-2" placeholder="Sisa Kuota" value="{{ old('conference_sidebar_sisa_kuota_label', $konten['conference_sidebar_sisa_kuota_label'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="conference_sidebar_peserta_label" class="form-control mb-2" placeholder="Peserta" value="{{ old('conference_sidebar_peserta_label', $konten['conference_sidebar_peserta_label'] ?? '') }}"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="conference_sidebar_tanggal_event_label" class="form-control" placeholder="Label Tanggal Event"
                                    value="{{ old('conference_sidebar_tanggal_event_label', $konten['conference_sidebar_tanggal_event_label'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="conference_countdown_title" class="form-control" placeholder="Judul Countdown"
                                    value="{{ old('conference_countdown_title', $konten['conference_countdown_title'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col"><input type="text" name="conference_countdown_label_hari" class="form-control mb-2" placeholder="Hari" value="{{ old('conference_countdown_label_hari', $konten['conference_countdown_label_hari'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="conference_countdown_label_jam" class="form-control mb-2" placeholder="Jam" value="{{ old('conference_countdown_label_jam', $konten['conference_countdown_label_jam'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="conference_countdown_label_menit" class="form-control mb-2" placeholder="Menit" value="{{ old('conference_countdown_label_menit', $konten['conference_countdown_label_menit'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="conference_countdown_label_detik" class="form-control mb-2" placeholder="Detik" value="{{ old('conference_countdown_label_detik', $konten['conference_countdown_label_detik'] ?? '') }}"></div>
                            </div>
                        </div>
                    </div>

                    {{-- ================= MUSICAL ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Trending Musikal</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Teks EVENT TRENDING</label>
                                <input type="text" name="musical_event_trending_text" class="form-control"
                                    value="{{ old('musical_event_trending_text', $konten['musical_event_trending_text'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Trending Musical</label>
                                <input type="text" name="trending_musical_title" class="form-control"
                                    value="{{ old('trending_musical_title', $konten['trending_musical_title'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col"><input type="text" name="trending_musical_countdown_hari" class="form-control mb-2" placeholder="Hari" value="{{ old('trending_musical_countdown_hari', $konten['trending_musical_countdown_hari'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="trending_musical_countdown_jam" class="form-control mb-2" placeholder="Jam" value="{{ old('trending_musical_countdown_jam', $konten['trending_musical_countdown_jam'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="trending_musical_countdown_menit" class="form-control mb-2" placeholder="Menit" value="{{ old('trending_musical_countdown_menit', $konten['trending_musical_countdown_menit'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="trending_musical_countdown_detik" class="form-control mb-2" placeholder="Detik" value="{{ old('trending_musical_countdown_detik', $konten['trending_musical_countdown_detik'] ?? '') }}"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subjudul Daftar Event Musikal</label>
                                <input type="text" name="musical_event_list" class="form-control"
                                    value="{{ old('musical_event_list', $konten['musical_event_list'] ?? '') }}">
                            </div>
                            <h6 class="fw-bold mt-4 mb-3">Sidebar & Countdown Musical</h6>
                            <div class="mb-3">
                                <input type="text" name="musical_sidebar_kuota_tanggal_title" class="form-control" placeholder="Judul Kuota & Tanggal"
                                    value="{{ old('musical_sidebar_kuota_tanggal_title', $konten['musical_sidebar_kuota_tanggal_title'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col"><input type="text" name="musical_sidebar_sisa_kuota_label" class="form-control mb-2" placeholder="Sisa Kuota" value="{{ old('musical_sidebar_sisa_kuota_label', $konten['musical_sidebar_sisa_kuota_label'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="musical_sidebar_peserta_label" class="form-control mb-2" placeholder="Peserta" value="{{ old('musical_sidebar_peserta_label', $konten['musical_sidebar_peserta_label'] ?? '') }}"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="musical_sidebar_tanggal_event_label" class="form-control" placeholder="Label Tanggal Event"
                                    value="{{ old('musical_sidebar_tanggal_event_label', $konten['musical_sidebar_tanggal_event_label'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="musical_countdown_title" class="form-control" placeholder="Judul Countdown"
                                    value="{{ old('musical_countdown_title', $konten['musical_countdown_title'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col"><input type="text" name="musical_countdown_label_hari" class="form-control mb-2" placeholder="Hari" value="{{ old('musical_countdown_label_hari', $konten['musical_countdown_label_hari'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="musical_countdown_label_jam" class="form-control mb-2" placeholder="Jam" value="{{ old('musical_countdown_label_jam', $konten['musical_countdown_label_jam'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="musical_countdown_label_menit" class="form-control mb-2" placeholder="Menit" value="{{ old('musical_countdown_label_menit', $konten['musical_countdown_label_menit'] ?? '') }}"></div>
                                <div class="col"><input type="text" name="musical_countdown_label_detik" class="form-control mb-2" placeholder="Detik" value="{{ old('musical_countdown_label_detik', $konten['musical_countdown_label_detik'] ?? '') }}"></div>
                            </div>
                        </div>
                    </div>

                    {{-- ================= NAVBAR ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Navbar</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Logo Navbar</label>
                                <div class="mb-2 text-center">
                                    <img src="{{ !empty($konten['navbar_logo']) ? asset('storage/'.$konten['navbar_logo']) : asset('assets/images/logo/no-images.png') }}"
                                        alt="Navbar Logo" class="img-fluid rounded border" style="max-height: 80px;">
                                </div>
                                <input type="file" name="navbar_logo" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Brand</label>
                                <input type="text" name="navbar_brand" class="form-control"
                                    value="{{ old('navbar_brand', $konten['navbar_brand'] ?? '') }}">
                            </div>
                        </div>
                    </div>

                    {{-- ================= FOOTER ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Footer</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Footer Logo</label>
                                <div class="mb-2 text-center">
                                    <img id="previewFooterLogo"
                                        src="{{ !empty($konten['footer_logo']) ? asset('storage/'.$konten['footer_logo']) : asset('assets/images/logo/logo-only.png') }}"
                                        alt="Footer Logo" class="img-fluid rounded border" style="max-height: 100px;">
                                </div>
                                <input type="file" name="footer_logo" id="footerLogoInput" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="footer_brand" class="form-control"
                                    value="{{ old('footer_brand', $konten['footer_brand'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="footer_description" rows="3" class="form-control">{{ old('footer_description', $konten['footer_description'] ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Copyright</label>
                                <input type="text" name="footer_copyright" class="form-control"
                                    value="{{ old('footer_copyright', $konten['footer_copyright'] ?? '') }}">
                            </div>
                        </div>
                    </div>

                    {{-- ================= Tiket ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Ticket Section</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Judul Section</label>
                                <input type="text" name="ticket_section_title" class="form-control"
                                    value="{{ old('ticket_section_title', $konten['ticket_section_title'] ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sub Judul Section</label>
                                <textarea name="ticket_section_subtitle" rows="3" class="form-control">{{ old('ticket_section_subtitle', $konten['ticket_section_subtitle'] ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul Event Musikal</label>
                                <input type="text" name="ticket_musikal_title" class="form-control"
                                    value="{{ old('ticket_musikal_title', $konten['ticket_musikal_title'] ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul Event Konferensi</label>
                                <input type="text" name="ticket_konferensi_title" class="form-control"
                                    value="{{ old('ticket_konferensi_title', $konten['ticket_konferensi_title'] ?? '') }}">
                            </div>
                        </div>
                    </div>

                    {{-- ================= Event List ================= --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Event Section</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Judul Event Musikal</label>
                                <input type="text" name="events_musikal_title" class="form-control"
                                    value="{{ old('events_musikal_title', $konten['events_musikal_title'] ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul Event Konferensi</label>
                                <input type="text" name="events_konferensi_title" class="form-control"
                                    value="{{ old('events_konferensi_title', $konten['events_konferensi_title'] ?? '') }}">
                            </div>
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
