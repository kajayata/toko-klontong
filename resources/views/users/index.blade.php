<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Kelontong - Kelola User</title>
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
    <h2>Kelola User</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-green">+ Tambah User</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-green">Edit</a>
                    <form action="{{ route('users.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada user. Silakan tambah user baru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p><a href="{{ route('admin.dashboard') }}">&larr; Kembali ke dashboard</a></p>
</body>
</html>
