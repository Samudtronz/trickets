document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("eventSearch");
    const resultsBox = document.getElementById("searchResults");

    if (!searchInput || !resultsBox) return;

    // --- buat preloader spinner ---
    const spinner = document.createElement("div");
    spinner.className = "flex justify-center items-center py-3";
    spinner.innerHTML = `
        <svg class="animate-spin h-5 w-5 text-[#F26417]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
    `;

    let timeout = null;

    searchInput.addEventListener("input", () => {
        const q = searchInput.value.trim();
        if (timeout) clearTimeout(timeout);

        resultsBox.classList.remove("hidden");
        resultsBox.innerHTML = ""; // reset

        if (!q) {
            resultsBox.classList.add("hidden");
            return;
        }

        // tampilkan spinner
        resultsBox.appendChild(spinner);

        timeout = setTimeout(async () => {
            try {
                // --- fetch konferensi ---
                let konfData = [];
                try {
                    const res = await fetch("http://192.168.100.65/projek-services/gateway-service/api/Userkonferensi", {
                        headers: { "X-GATEWAY-KEY": "CON123" }
                    });
                    konfData = await res.json();
                } catch (e) {
                    console.error("Konferensi API error:", e);
                }

                // --- fetch musik ---
                let musikData = [];
                try {
                    const res = await fetch("http://192.168.100.69/musikal/api-gateway/api/musikal", {
                        headers: { "X-GATEWAY-KEY": "musikal123" }
                    });
                    musikData = await res.json();
                } catch (e) {
                    console.error("Musik API error:", e);
                }

                // --- filter konferensi ---
                const konfMatches = (konfData.data || konfData || []).filter(item =>
                    (item.judul || "").toLowerCase().includes(q.toLowerCase())
                ).map(item => ({ ...item, type: "konferensi" }));

                // --- filter musik ---
                const musikMatches = (musikData.data || musikData || []).filter(item =>
                    (item.judul || "").toLowerCase().includes(q.toLowerCase())
                ).map(item => ({ ...item, type: "musik" }));

                const matches = [...konfMatches, ...musikMatches];

                // --- render hasil ---
                resultsBox.innerHTML = "";

                if (matches.length) {
                    matches.forEach(item => {
                        const a = document.createElement("a");

                        // --- link detail per id ---
                        if (item.type === "konferensi") {
                            a.href = `http://192.168.100.65/trickets/home-konferensi/detail/${item.id}`;
                        } else if (item.type === "musik") {
                            a.href = `http://192.168.100.65/trickets/event/musik/${item.id}`;
                        }

                        // --- base url sesuai tipe ---
                        let baseUrl = "";
                        if (item.type === "konferensi") {
                            baseUrl = "http://192.168.100.65/projek-services/konferensi-service/storage/";
                        } else if (item.type === "musik") {
                            baseUrl = "http://192.168.100.69/musikal/api-gateway/storage/";
                        }

                        const poster =
                            item.foto_event_url ||
                            item.foto_event ||
                            item.foto ||
                            "/assets/images/no-image.png";

                        // --- desain modern ---
                        a.innerHTML = `
                            <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/10 transition">
                                <img src="${poster.startsWith('http') ? poster : baseUrl + poster}"
                                     class="w-14 h-14 object-cover rounded-lg shadow" />
                                <div class="flex flex-col">
                                    <p class="font-semibold text-white text-sm line-clamp-1">${item.judul}</p>
                                    <p class="text-xs text-gray-400">${item.lokasi ?? "-"}</p>
                                    <p class="text-xs text-gray-400">${item.tanggal ?? "-"}</p>
                                </div>
                                <span class="ml-auto text-[10px] px-2 py-1 rounded-full 
                                    ${item.type === "konferensi" ? "bg-blue-600" : "bg-pink-600"} text-white">
                                    ${item.type}
                                </span>
                            </div>
                        `;
                        resultsBox.appendChild(a);
                    });
                } else {
                    resultsBox.innerHTML =
                        `<p class="px-4 py-2 text-sm text-gray-400">Tidak ada hasil</p>`;
                }
            } catch (err) {
                console.error("Search error:", err);
                resultsBox.innerHTML =
                    `<p class="px-4 py-2 text-sm text-gray-400">Terjadi kesalahan</p>`;
            }
        }, 400);
    });

    // --- sembunyikan saat klik luar ---
    document.addEventListener("click", e => {
        if (!resultsBox.contains(e.target) && e.target !== searchInput) {
            resultsBox.classList.add("hidden");
        }
    });
});
