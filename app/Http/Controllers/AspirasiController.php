<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi; 
use App\Models\Kategori; 
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function indexKategori()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required|string|max:255|unique:kategori,ket_kategori',
        ]);

        Kategori::create([
            'ket_kategori' => $request->ket_kategori
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function destroyKategori($id)
    {
        Kategori::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }

public function adminDashboard(Request $request)
{
    $query = Aspirasi::with(['user', 'kategori']); // Tambahkan 'user' di sini

    if ($request->filled('kategori')) {
        $query->where('id_kategori', $request->kategori);
    }

    $aspirasis = $query->latest()->get();
    
    return view('admin.dashboard', compact('aspirasis'));
}

    public function siswaDashboard()
    {
        $aspirasis = Aspirasi::where('nis', auth()->user()->id)
                    ->with('kategori')
                    ->latest()
                    ->get();
        
        $kategoris = Kategori::all();
        
        return view('siswa.dashboard', compact('aspirasis', 'kategoris'));
    }

public function storeAspirasi(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'lokasi'      => 'required|max:50',
        'ket'         => 'required|max:255',
        'foto'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
    ]);

    $path = null;
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('pengaduan', 'public');
    }

    Aspirasi::create([
        'nis'         => auth()->user()->id, // Mengambil ID user yang login
        'id_kategori' => $request->id_kategori,
        'lokasi'      => $request->lokasi,
        'ket'         => $request->ket,
        'foto'        => $path,              // Simpan path foto
        'status'      => 'Menunggu',
    ]);

    return back()->with('success', 'Aspirasi berhasil dikirim dengan bukti foto!');
}

   
    public function updateAspirasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'required'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return back()->with('success', 'Umpan balik berhasil dikirim!');
    }
}