<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Aplikasi Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h4 class="text-center fw-bold">Login</h4>
                        <p class="text-center text-muted small">Masuk untuk menyampaikan aspirasi Anda</p>
                        <hr>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">NIS atau Email Admin</label>
                                <input type="text" name="login" class="form-control" 
                                       placeholder="Masukkan NIS (Siswa) atau Email (Admin)" 
                                       value="{{ old('login') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" 
                                       placeholder="Masukkan Password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Ingat Saya</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                        </form>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Daftar Siswa</a></p>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-4 text-muted small">&copy; 2026 Aplikasi Aspirasi Siswa</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>