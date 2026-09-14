<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Kelontong - Data Barang</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-green { background: #28a745; color: white; }
        .btn-red { background: #dc3545; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Daftar Barang Toko Kelontong</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-green">+ Tambah Barang</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga (Rp)</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>
                    <form action="{{ route('products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada barang di toko kelontong.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>