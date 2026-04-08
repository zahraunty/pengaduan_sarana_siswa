<form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="id_kategori" class="form-select" required>
            @foreach($kategoris as $k)
                <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Lokasi Kejadian</label>
        <input type="text" name="lokasi" class="form-control" placeholder="Misal: Lab RPL 2" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Keterangan Kerusakan</label>
        <textarea name="ket" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Upload Foto Bukti</label>
        <input type="file" name="foto" class="form-control" accept="image/*" required>
        <small class="text-muted">Format: JPG, PNG (Maks 2MB)</small>
    </div>

    <button type="submit" class="btn btn-primary w-100">Kirim Aspirasi</button>
</form>

<td>
    <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
        <img src="{{ asset('storage/' . $item->foto) }}" width="50" class="rounded shadow-sm">
    </a>
</td>