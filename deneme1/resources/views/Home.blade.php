@include('menu')

<h1>Merhaba 👋</h1>

@isset($kullanici)
    <p>Hoş geldin, {{ $kullanici }}!</p>
@endisset

@auth
    <a href="/profil">Profiline git</a>
@endauth

@guest
    <a href="/kayit">Kayıt ol</a>
@endguest

<form action="{{ url('/giris') }}" method="POST">
    @csrf
    <label for="kullanici">Kullanıcı Adı:</label>
    <input type="text" id="kullanici" name="kullanici" required><br>

    <label for="sifre">Şifre:</label>
    <input type="password" id="sifre" name="sifre" required><br>

    <button type="submit">Giriş Yap</button>
</form>

@once
    <div style="border:1px solid #ccc; padding:10px; margin-top:15px; background-color:#f9f9f9;">
        Güvenliğiniz için bilgileriniz gizlidir.
    </div>
@endonce
