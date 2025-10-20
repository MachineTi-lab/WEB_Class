@php
$ogrenciler = [
    ['ad' => 'Halil', 'numara' => '1001', 'bolum' => 'Bilgisayar', 'not' => 90, 'durum' => 'aktif'],
    ['ad' => 'Ayşe', 'numara' => '1002', 'bolum' => 'Elektrik', 'not' => 60, 'durum' => 'pasif'],
    ['ad' => 'Emre', 'numara' => '1003', 'bolum' => 'Makine', 'not' => 40, 'durum' => 'aktif'],
    ['ad' => 'Deniz', 'numara' => '1004', 'bolum' => 'Bilgisayar', 'not' => 75, 'durum' => 'aktif'],
    ['ad' => 'Mert', 'numara' => '1005', 'bolum' => 'Elektrik', 'not' => 0, 'durum' => 'aktif'],
];
@endphp

<h1>Kayıtlı Öğrenciler</h1>

<ul>
    @forelse($ogrenciler as $ogr)

        {{-- Notu 0 olan öğrenciyi atla --}}
        @continue($ogr['not'] === 0)

        {{-- Belirli bir öğrenciye ulaşıldığında döngüyü kır (örnek: Emre) --}}
        @break($ogr['ad'] === 'Emre')

        <li 
            @class([
                'aktif' => $ogr['durum'] === 'aktif', 
                'pasif' => $ogr['durum'] === 'pasif'
            ])
            @style([
                'color: red;' => $ogr['not'] < 50
            ])
        >
            {{ $loop->iteration }}. {{ $ogr['ad'] }} - {{ $ogr['numara'] }} - {{ $ogr['bolum'] }} - Not: {{ $ogr['not'] }}
        </li>
    @empty
        <li>Henüz öğrenci kaydı yok.</li>
    @endforelse
</ul>

{{-- Sadece yönetici giriş yapmışsa "Yeni öğrenci ekle" butonu göster --}}
@includeWhen(Auth::check() && Auth::user()->role === 'admin', 'partials.yeni_ogrenci_ekle')
