<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Baru</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-group { margin-bottom: 12px; }
        label { display: block; margin-bottom: 4px; }
        input, select { width: 300px; padding: 6px; }
    </style>
</head>
<body>
    <h2>Tambah Barang Baru</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_produk" required>
        </div>
        <div class="form-group">
            <label>Kategori:</label>
            <select name="kategori" required>
                <option value="Sembako">Sembako</option>
                <option value="Minuman">Minuman</option>
                <option value="Snack">Snack</option>
                <option value="Kebutuhan Rumah">Kebutuhan Rumah</option>
            </select>
        </div>
        <div class="form-group">
            <label>Harga (Rp):</label>
            <input type="number" name="harga" required>
        </div>
        <div class="form-group">
            <label>Stok Awal:</label>
            <input type="number" name="stok" required>
        </div>

        <button type="submit">Simpan Barang</button>
        <a href="{{ route('products.index') }}">Kembali</a>
    </form>
</body>
</html>