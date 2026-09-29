<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
    <h2>Edit User: {{ $user->name }}</h2>

    @if($errors->any())
        <ul class="errors">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label>Password Baru (min. 8 karakter):</label>
            <input type="password" name="password">
            <span class="error">Kosongkan password bila tidak ingin mengubahnya.</span>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password Baru:</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('users.index') }}">Kembali</a>
    </form>
</body>
</html>
