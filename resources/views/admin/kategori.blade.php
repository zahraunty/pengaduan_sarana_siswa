<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manajemen Kategori - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white"><strong>Tambah Kategori</strong></div>
                    <div class="card-body">
                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Nama Kategori</label>
                                <input type="text" name="ket_kategori" class="form-control" placeholder="Contoh: Sarana Lab" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Simpan Kategori</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3 w-100">Kembali ke Dashboard</a>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white"><strong>Daftar Kategori Tersedia</strong></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategoris as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $k->ket_kategori }}</td>
                                    <td>
                                        <form action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>