<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Toko Kelontong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center bg-success bg-gradient min-vh-100">

<div class="card shadow-lg border-0" style="width: 26rem;">
    <div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
            <i class="bi bi-shop display-3 text-success"></i>
            <h1 class="h4 mb-1">Login Admin</h1>
            <p class="text-body-secondary mb-0">Masuk ke dashboard Toko Kelontong</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2" role="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="admin@toko.test" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="******" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-semibold mb-2">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Dashboard
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('home') }}" class="text-decoration-none small"><i class="bi bi-house"></i> Kembali ke halaman utama</a>
        </div>
    </div>
</div>

</body>
</html>