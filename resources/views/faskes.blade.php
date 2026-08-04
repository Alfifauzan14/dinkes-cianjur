<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fasilitas Kesehatan - Dinkes Cianjur</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/Faskes/faskes.css') }}?v={{ time() }}">
    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- FontAwesome for Brands --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #FFFFFF; margin: 0; padding: 0; min-height: 100vh;">
    @include('layouts.navbar')

    <div class="faskes-page-wrapper">
    <!-- Header Section -->
    <header class="faskes-header">
        <div class="faskes-header-container">
            <h1 class="faskes-header-title">Fasilitas Kesehatan Kabupaten Cianjur</h1>
            <p class="faskes-header-subtitle">Peta interaktif Rumah Sakit dan Puskesmas di seluruh wilayah Kabupaten Cianjur</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="faskes-content">
        <div class="faskes-container">

            <!-- Title Section -->
            <div class="faskes-title-section">
                <h2 class="faskes-main-title">Peta & Daftar Puskesmas & Rumah Sakit</h2>
                <p class="faskes-main-subtitle">Gunakan filter untuk mencari faskes berdasarkan kecamatan atau jenis layanan.</p>
            </div>

            <!-- Filter Card -->
            <form action="{{ url('/faskes') }}" method="GET" class="faskes-filter-card">
                <div class="faskes-filter-section">
                    <div class="faskes-search-wrap">
                        <input type="text" name="search" class="faskes-search-input" placeholder="Cari nama Puskesmas..." value="{{ request('search') }}">
                        <button type="submit" class="faskes-search-btn">Cari</button>
                    </div>
                    <div class="faskes-filter-wrap">
                        <select name="kecamatan" class="faskes-select" onchange="this.form.submit()">
                            <option value="Semua" {{ request('kecamatan', 'Semua') == 'Semua' ? 'selected' : '' }}>Semua Wilayah...</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec }}" {{ request('kecamatan') == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="faskes-filter-wrap">
                        <select name="type" class="faskes-select" onchange="this.form.submit()">
                            <option value="Semua" {{ request('type', 'Semua') == 'Semua' ? 'selected' : '' }}>Semua Layanan...</option>
                            <option value="Rumah Sakit" {{ request('type') == 'Rumah Sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                            <option value="Puskesmas" {{ request('type') == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Map & List Layout -->
            <div class="faskes-main-layout">

                <!-- Map Section (Left) -->
                <div class="faskes-map-container">
                    <div id="faskesMap" style="width:100%; height:100%; border-radius:3px;"></div>
                </div>

                <!-- Facility List (Right) -->
                <div class="faskes-list" id="faskesList">
                    @forelse($faskes as $item)
                        <div class="faskes-card" data-lat="{{ $item->lat }}" data-lng="{{ $item->lng }}" data-name="{{ $item->name }}">
                            <div class="faskes-card-header">
                                <h3 class="faskes-card-name">{{ $item->name }}</h3>
                                <div class="faskes-card-badges">
                                    @if($item->type === 'Rumah Sakit')
                                        <span class="faskes-badge faskes-badge-red">Rumah Sakit</span>
                                    @else
                                        <span class="faskes-badge faskes-badge-green">Puskesmas</span>
                                    @endif
                                    @if($item->akreditasi)
                                        <span class="faskes-badge faskes-badge-blue">{{ $item->akreditasi }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="faskes-card-info">
                                <div class="faskes-info-item">
                                    <span class="faskes-info-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </span>
                                    <span>{{ $item->address }}, Kec. {{ $item->kecamatan }}</span>
                                </div>
                                @if($item->phone)
                                <div class="faskes-info-item">
                                    <span class="faskes-info-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    </span>
                                    <span>{{ $item->phone }}</span>
                                </div>
                                @endif
                                @if($item->jam_operasional)
                                <div class="faskes-info-item">
                                    <span class="faskes-info-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    </span>
                                    <span>{{ $item->jam_operasional }}</span>
                                </div>
                                @endif
                                @if($item->layanan)
                                <div class="faskes-info-item faskes-layanan">
                                    <span class="faskes-info-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                                    </span>
                                    <span>{{ $item->layanan }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="faskes-card-actions">
                                <button class="faskes-btn faskes-btn-peta" onclick="showOnMap({{ $item->lat }}, {{ $item->lng }}, '{{ $item->name }}')">
                                    <span class="faskes-btn-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </span>
                                    Lihat di Peta
                                </button>
                                @if($item->phone)
                                <a href="https://wa.me/62{{ ltrim($item->phone, '(0)') }}" target="_blank" class="faskes-btn faskes-btn-wa">
                                    <span class="faskes-btn-icon">
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    </span>
                                    Hubungi WA
                                </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="faskes-empty">
                            <p>Tidak ada faskes ditemukan untuk filter ini.</p>
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </main>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const faskesData = @json($faskes);

    // Initialize map centered on Cianjur
    const map = L.map('faskesMap').setView([-6.81, 107.13], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 18,
    }).addTo(map);

    // Custom icons
    const rsIcon = L.divIcon({
        className: 'custom-marker rs-marker',
        html: '<div style="background:#DC2626;width:32px;height:32px;border-radius:50%;border:3px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><span style="color:#fff;font-size:14px;font-weight:700;">RS</span></div>',
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        popupAnchor: [0, -20]
    });

    const pkIcon = L.divIcon({
        className: 'custom-marker pk-marker',
        html: '<div style="background:#004F3B;width:28px;height:28px;border-radius:50%;border:3px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><span style="color:#fff;font-size:11px;font-weight:700;">PK</span></div>',
        iconSize: [28, 28],
        iconAnchor: [14, 14],
        popupAnchor: [0, -16]
    });

    // Add markers
    const markers = [];
    faskesData.forEach(function(f) {
        const icon = f.type === 'Rumah Sakit' ? rsIcon : pkIcon;
        const gmapsUrl = 'https://www.google.com/maps/dir/?api=1&destination=' + f.lat + ',' + f.lng;
        const marker = L.marker([f.lat, f.lng], { icon: icon })
            .addTo(map)
            .bindPopup(
                '<div style="min-width:220px;">' +
                '<strong style="font-size:14px;color:#004F3B;">' + f.name + '</strong><br>' +
                '<span style="font-size:12px;color:#6B7280;">' + f.type + ' - ' + f.kecamatan + '</span><br>' +
                '<span style="font-size:12px;color:#374151;">' + f.address + '</span><br>' +
                (f.phone ? '<span style="font-size:12px;color:#374151;">' + f.phone + '</span><br>' : '') +
                '<a href="' + gmapsUrl + '" target="_blank" style="display:inline-flex;align-items:center;gap:4px;margin-top:8px;padding:6px 12px;background:#004F3B;color:#fff;border-radius:3px;font-size:12px;font-weight:600;text-decoration:none;">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>' +
                'Buka di Google Maps</a>' +
                '</div>'
            );
        markers.push({ marker: marker, data: f });
    });

    // Fit bounds to show all markers
    if (markers.length > 0) {
        const group = L.featureGroup(markers.map(m => m.marker));
        map.fitBounds(group.getBounds().pad(0.1));
    }

    // Show on map function
    function showOnMap(lat, lng, name) {
        map.setView([lat, lng], 15);
        const found = markers.find(m => m.data.name === name);
        if (found) {
            found.marker.openPopup();
        }
        // Scroll to map on mobile
        if (window.innerWidth < 992) {
            document.getElementById('faskesMap').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
</script>

@include('layouts.footer')
</body>
</html>
