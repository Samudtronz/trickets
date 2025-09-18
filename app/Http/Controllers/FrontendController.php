<?php

    namespace App\Http\Controllers;

    use App\Models\Frontend;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;


    class FrontendController extends Controller
    {
            // Halaman welcome (frontend)
        public function welcome()
        {
            $keys = ['home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo'];
            $konten = Frontend::whereIn('key', $keys)->pluck('value', 'key')->toArray();

            // Tambahkan helper URL untuk background dan logo
            $konten['home_background_url'] = !empty($konten['home_background'])
                ? asset('storage/' . $konten['home_background']) // pakai storage link
                : asset('assets/images/backgrounds/bg-welcome.png');

            $konten['home_logo_url'] = !empty($konten['home_logo'])
                ? asset('storage/' . $konten['home_logo'])
                : asset('assets/images/logo/logo-only.png');

            return view('frontend.welcome', compact('konten'));
        }


        // Update konten berdasarkan key
        public function edit()
        {
            $keys = ['home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo'];
            $konten = Frontend::whereIn('key', $keys)->pluck('value', 'key');

            return view('backend.edit', compact('konten'));
        }

        public function update(Request $request)
        {
            $keys = ['home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo'];
            $konten = Frontend::whereIn('key', $keys)->pluck('value', 'key')->toArray();

            $data = [
                'home_title' => $request->title,
                'home_tagline' => $request->tagline,
                'home_description' => $request->description,
                'home_background' => $request->hasFile('background')
                    ? $request->file('background')->store('images/backgrounds', 'public') // folder di storage/app/public
                    : ($konten['home_background'] ?? 'images/backgrounds/no-images.png'),
                'home_logo' => $request->hasFile('logo')
                    ? $request->file('logo')->store('images/logo', 'public') // folder di storage/app/public
                    : ($konten['home_logo'] ?? 'images/logo/no-images.png'),
            ];

            foreach ($data as $key => $value) {
                Frontend::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->back()->with('success', 'Konten berhasil diperbarui');
        }

}