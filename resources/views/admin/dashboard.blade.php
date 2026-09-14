<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Toko Kelontong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        #wrapper { display: flex; min-height: 100vh; }
        #sidebar { width: 250px; background: #212529; flex-shrink: 0; }
        #sidebar .nav-link { color: rgba(255,255,255,.7); }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.1); }
        #content { flex: 1; min-width: 0; }
    </style>
</head>
<body>

<div id="wrapper">

    <aside id="sidebar" class="d-flex flex-column p-0">
        <a class="d-flex align-items-center gap-2 text-white text-decoration-none px-3 py-3 border-bottom border-secondary" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shop fs-4"></i>
            <span class="fw-semibold">Toko Kelontong</span>
        </a>
        <ul class="nav nav-pills flex-column p-2 mt-2">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}"><i class="bi bi-box-seam me-2"></i>Manajemen Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.create') }}"><i class="bi bi-plus-circle me-2"></i>Tambah Barang</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-eye me-2"></i>Lihat Situs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
            </li>
        </ul>
    </aside>

    <div id="content" class="d-flex flex-column">
        <nav class="navbar navbar-expand bg-white shadow-sm px-4 py-2 border-bottom">
            <div class="container-fluid justify-content-between">
                <span class="fw-semibold fs-5">Dashboard</span>
                <span class="badge text-bg-success"><i class="bi bi-person-circle me-1"></i>Admin</span>
            </div>
        </nav>

        <main class="container-fluid py-4 bg-body-tertiary flex-grow-1">

            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-bg-primary border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-uppercase">Total Produk</div>
                                <div class="fs-3 fw-bold">{{ $stats['totalProducts'] }}</div>
                            </div>
                            <i class="bi bi-box-seam fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-bg-success border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-uppercase">Total Stok</div>
                                <div class="fs-3 fw-bold">{{ $stats['totalStock'] }}</div>
                            </div>
                            <i class="bi bi-boxes fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-bg-warning border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-uppercase">Nilai Stok</div>
                                <div class="fs-3 fw-bold">Rp {{ number_format($stats['totalValue'], 0, ',', '.') }}</div>
                            </div>
                            <i class="bi bi-cash-stack fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card text-bg-danger border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-uppercase">Stok Menipis</div>
                                <div class="fs-3 fw-bold">{{ $stats['lowStock'] }} barang</div>
                            </div>
                            <i class="bi bi-exclamation-triangle fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-7">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">
                            Produk Terbaru
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-success float-end">Kelola Barang</a>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $item)
                                    <tr>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td><span class="badge text-bg-secondary">{{ $item->kategori }}</span></td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($item->stok <= 5)
                                                <span class="badge text-bg-danger">{{ $item->stok }}</span>
                                            @else
                                                {{ $item->stok }}
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center text-body-secondary py-4">Belum ada barang.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">Stok per Kategori</div>
                        <div class="card-body">
                            @forelse($categories as $c)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <span>{{ $c->kategori }} <span class="badge text-bg-light ms-1">{{ $c->jumlah }} produk</span></span>
                                <span class="fw-semibold">{{ $c->stok }} item</span>
                            </div>
                            @empty
                            <p class="text-body-secondary mb-0">Belum ada data.</p>
                            @endforelse
                        </div>
                        <div class="card-footer bg-white d-grid">
                            <a href="{{ route('products.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i>Tambah Barang Baru</a>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <footer class="text-center text-body-secondary py-3 small border-top bg-white">
            &copy; {{ date('Y') }} Toko Kelontong Berkah
        </footer>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>