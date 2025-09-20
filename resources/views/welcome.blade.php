<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="welcome-page">

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo"></span></div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="{{ route('login.form') }}" class="btn-login">Login</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-text">
            <h1>Haiii, Selamat Datang di <span>Skins</span></h1>
            <p>
                Tempat dimana kamu bisa diagnosa permasalahan kulit tanpa perlu datang ke Klinik Marisa.  
                Yuk akses permasalahan kulitmu sekarang.
            </p>
            <a href="{{ route('login.form') }}" class="btn-primary">Mulai Diagnosa</a>
        </div>
        <div class="hero-img">
            <img src="{{ asset('images/skin.jpeg') }}" alt="Ilustrasi Diagnosa">
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
       
    </footer>

</body>
</html>
