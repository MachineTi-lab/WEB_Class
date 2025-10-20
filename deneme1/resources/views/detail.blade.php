{{-- Student detay sayfası --}}
@use(App\Models\Student)

@php
    // Örnek öğrenci verisi (genellikle controller'dan gelir)
    $ogrenci = [
        'ad' => 'Halil',
        'numara' => '1001',
        'bolum' => 'Bilgisayar',
        'notlar' => [90, 85, 80],
        'email' => 'halil@example.com'
    ];

    // Ortalama hesaplama
    $ortalama = count($ogrenci['notlar']) ? array_sum($ogrenci['notlar']) / count($ogrenci['notlar']) : 0;
@endphp

<h1>Öğrenci Detayları</h1>

{{-- Öğrencinin temel bilgileri --}}
<p>Adı: {{ $ogrenci['ad'] }}</p>
<p>Numarası: {{ $ogrenci['numara'] }}</p>
<p>Bölümü: {{ $ogrenci['bolum'] }}</p>

{{-- Başarı durumu @switch --}}
@switch(true)
    @case($ortalama >= 85)
        <p>Başarı Durumu: Mükemmel</p>
        @break
    @case($ortalama >= 70)
        <p>Başarı Durumu: İyi</p>
        @break
    @case($ortalama >= 50)
        <p>Başarı Durumu: Orta</p>
        @break
    @default
        <p>Başarı Durumu: Kaldı</p>
@endswitch

{{-- Ortalama not --}}
<p>Ortalama Not: {{ $ortalama }}</p>

{{-- Opsiyonel alan kontrolü --}}
@isset($ogrenci['email'])
    <p>E-posta: {{ $ogrenci['email'] }}</p>
@endisset

{{-- Öğrenci kartını dahil etme --}}
@include('partials.ogrenci_karti', ['ogrenci' => $ogrenci])

{{-- Örnek form alanları --}}
<form>
    <label for="ad">Ad:</label>
    <input type="text" id="ad" name="ad" value="{{ $ogrenci['ad'] }}" @readonly><br>

    <label for="numara">Numara:</label>
    <input type="text" id="numara" name="numara" value="{{ $ogrenci['numara'] }}" @disabled><br>

    <label for="email">E-posta:</label>
    <input type="email" id="email" name="email" value="{{ $ogrenci['email'] ?? '' }}" @required><br>
</form>

{{-- Sadece öğretmen rolündeki kullanıcılar görebilsin --}}
@auth
    @if(Auth::user()->role === 'teacher')
        <button>Not Düzenle</button>
    @endif
@endauth

{{-- Sayfa sonunda yalnızca bir kez gösterilecek mesaj --}}
@once
    <p>Tüm bilgiler gizlidir.</p>
@endonce

{{-- Blade yorum satırı --}}
{{-- Bu satır sadece geliştirici tarafından görülebilir, kullanıcıya gösterilmez --}}
