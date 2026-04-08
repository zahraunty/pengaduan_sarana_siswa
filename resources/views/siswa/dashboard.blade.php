<!DOCTYPE html>
<html lang="id">
<head>
    <title>Halaman Siswa - Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Portal Aspirasi Siswa</span>
            <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-light btn-sm">Logout</button></form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white"><strong>Kirim Aspirasi</strong></div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Kategori Sarana</label>
                                <select name="id_kategori" class="form-select" required>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi (Misal: Kelas XII RPL 1)</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Lokasi spesifik..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan Masalah</label>
                                <textarea name="ket" class="form-control" rows="3" placeholder="Jelaskan kerusakan..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Bukti Kerusakan</label>
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                <div class="form-text">Gunakan format JPG, PNG, atau JPEG.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Kirim Pengaduan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white"><strong>Histori & Progres Perbaikan</strong></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Foto</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Umpan Balik Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aspirasis as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="align-middle">
                                            @if($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Bukti" style="width: 60px; height: 60px; object-fit: cover;" class="rounded border">
                                            @else
                                                <span class="text-muted small">No Photo</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $item->kategori->ket_kategori }}</td>
                                        <td class="align-middle">
                                            <span class="badge {{ $item->status == 'Selesai' ? 'bg-success' : ($item->status == 'Proses' ? 'bg-warning' : 'bg-secondary') }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <small class="text-muted">{{ $item->feedback ?? 'Belum ada tanggapan' }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-4">Belum ada histori aspirasi.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>