<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-group { margin-bottom: 12px; }
        label { display: block; margin-bottom: 4px; }
        input, select { width: 300px; padding: 6px; }
        .error { color: #dc3545; font-size: 14px; }
        ul.errors { color: #dc3545; }
    </style>
</head>
<body>
    <h2>Tambah User Baru</h2>

    @if($errors->any())
        <ul class="errors">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>Password (min. 8 karakter):</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" required>
            <span class="error">Rule "confirmed" akan menolak submit bila kedua password tidak sama.</span>
        </div>

        <button type="submit">Simpan User</button>
        <a href="{{ route('users.index') }}">Kembali</a>
    </form>
</body>
</html>
