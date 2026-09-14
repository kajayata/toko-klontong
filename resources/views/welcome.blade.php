<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Kelontong Berkah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-shop"></i> Toko Kelontong Berkah
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-warning fw-semibold" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> Login Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="bg-success text-white text-center py-5">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Belanja Kebutuhan Sehari-hari</h1>
        <p class="lead">Sembako, minuman, snack, dan kebutuhan rumah tangga dengan harga bersahabat.</p>
        <a href="#produk" class="btn btn-warning btn-lg fw-semibold mt-2">Lihat Produk</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg mt-2"><i class="bi bi-gear"></i> Dashboard Admin</a>
    </div>
</header>

<section id="produk" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Produk Unggulan</h2>
        <div class="row">
            @forelse($products as $item)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->nama_produk }}</h5>
                        <span class="badge text-bg-secondary align-self-start mb-2">{{ $item->kategori }}</span>
                        <p class="card-text fs-5 text-success fw-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="card-footer text-body-secondary d-flex justify-content-between">
                        <span>Stok: {{ $item->stok }}</span>
                        <a href="{{ route('login') }}" class="btn btn-sm btn-success"><i class="bi bi-cart-plus"></i> Beli</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Produk belum tersedia. Kunjungi kembali nanti.</div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id="tentang" class="bg-white py-5">
    <div class="container">
        <h2 class="text-center mb-4">Kenapa Pilih Kami?</h2>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <i class="bi bi-basket2 display-6 text-success"></i>
                <h5 class="mt-2">Lengkap</h5>
                <p>Kebutuhan pokok hingga rumah tangga tersedia.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-tag display-6 text-success"></i>
                <h5 class="mt-2">Harga Bersahabat</h5>
                <p>Harga hemat sesuai kantong semua kalangan.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-emoji-smile display-6 text-success"></i>
                <h5 class="mt-2">Ramah</h5>
                <p>Dilayani langsung oleh pemilik toko.</p>
            </div>
        </div>
    </div>
</section>

<footer id="kontak" class="bg-dark text-white-50 py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div>
            <span class="text-white fw-bold">Toko Kelontong Berkah</span><br>
            Jl. Melati No. 12, Bandung | 0812-3456-7890
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('login') }}" class="text-decoration-none text-white-50"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            <span>&copy; 2026</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>