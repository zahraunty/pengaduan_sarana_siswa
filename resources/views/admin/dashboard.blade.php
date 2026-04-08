<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumbnail-custom {
            width: 80px;
            height: 60px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .img-thumbnail-custom:hover {
            transform: scale(1.1);
        }
        .text-xs {
            font-size: 0.75rem;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">Admin Panel - Aspirasi Siswa</span>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.kategori.index') }}">Manajemen Kategori</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf 
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white"><strong>Filter Data Aspirasi</strong></div>
            <div class="card-body">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold">Berdasarkan Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold">Berdasarkan Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach(\App\Models\Kategori::all() as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">Cari Data</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>List Aspirasi Masuk</strong>
                <span class="badge bg-dark">{{ $aspirasis->count() }} Data</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th style="width: 20%">Identitas Siswa</th>
                                <th style="width: 12%">Bukti Foto</th>
                                <th style="width: 13%">Kategori</th>
                                <th style="width: 30%">Lokasi & Keterangan</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $item)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->user->name ?? 'User dihapus' }}</div>
                                    <div class="text-muted text-xs">
                                        NIS: {{ $item->user->nis ?? '-' }} | Kelas: {{ $item->user->kelas ?? '-' }}
                                    </div>
                                    <div class="text-xs text-primary mt-1">
                                       {{ $item->created_at->format('d/m/Y H:i') }} WIB
                                    </div>
                                </td>
                                <td>
                                    @if($item->foto)
                                        <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->foto) }}" 
                                                 class="img-thumbnail-custom rounded border shadow-sm">
                                        </a>
                                    @else
                                        <span class="text-muted small"><em>Tanpa Foto</em></span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $item->kategori->ket_kategori ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary mb-1">{{ $item->lokasi }}</div>
                                    <div class="small text-muted" style="line-height: 1.4;">{{ $item->ket }}</div>
                                </td>
                                <td>
                                    @php
                                        $badgeColor = [
                                            'Selesai' => 'bg-success',
                                            'Proses' => 'bg-warning text-dark',
                                            'Menunggu' => 'bg-secondary'
                                        ][$item->status] ?? 'bg-dark';
                                    @endphp
                                    <span class="badge {{ $badgeColor }} shadow-sm px-3 py-2">{{ $item->status }}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapseUpdate{{ $item->id_aspirasi }}">
                                        Tanggapi
                                    </button>
                                </td>
                            </tr>

                           <tr class="collapse" id="collapseUpdate{{ $item->id_aspirasi }}">
    <td colspan="6" class="bg-light p-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center border-end">
                        <label class="fw-bold d-block mb-2 text-muted small">DETAIL FOTO BUKTI</label>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded border mb-2 shadow-sm">
                            <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" class="btn btn-sm btn-link text-decoration-none">Perbesar Gambar</a>
                        @else
                            <div class="py-5 bg-white border rounded text-muted small">Tidak Ada Lampiran Foto</div>
                        @endif
                    </div>

                    <div class="col-md-9 ps-4">
                        @if($item->komentar_siswa)
                            <div class="alert alert-info border-0 shadow-sm mb-4">
                                <h6 class="fw-bold"><i class="bi bi-chat-left-text-fill"></i> Balasan dari Siswa:</h6>
                                <p class="mb-0 italic text-dark">"{{ $item->komentar_siswa }}"</p>
                                <hr>
                                <small class="text-muted">Gunakan form di bawah jika ingin memperbarui tanggapan Admin.</small>
                            </div>
                        @endif

                        <h6 class="mb-3 text-primary d-flex align-items-center">
                            <span class="me-2">Memberi Tanggapan:</span>
                            <span class="badge bg-primary px-3">{{ $item->user->name ?? 'Siswa' }} ({{ $item->user->kelas ?? '-' }})</span>
                        </h6>
                        
                        <form action="{{ route('admin.update', $item->id_aspirasi) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-muted">Update Status</label>
                                    <select name="status" class="form-select border-primary shadow-sm">
                                        <option value="Menunggu" {{ $item->status == 'Menunggu' ? 'selected' : '' }}>🕒 Menunggu</option>
                                        <option value="Proses" {{ $item->status == 'Proses' ? 'selected' : '' }}>🔄 Proses</option>
                                        <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold small text-muted">Isi Umpan Balik (Feedback Admin)</label>
                                    <textarea name="feedback" class="form-control border-primary shadow-sm" rows="3" placeholder="Tulis tanggapan admin di sini..." required>{{ $item->feedback }}</textarea>
                                </div>
                                <div class="col-12 text-end mt-2">
                                    <button type="submit" class="btn btn-success px-5 shadow rounded-pill">Simpan Progress</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25">
                                    <div class="text-muted">Belum ada aspirasi yang masuk.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>