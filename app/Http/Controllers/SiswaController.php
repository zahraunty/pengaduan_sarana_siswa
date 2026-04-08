<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    
    public function index()
    {
        $kategoris = Kategori::all();
        
        $aspirasis = Aspirasi::with('kategori')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        
        return view('siswa.index', compact('kategoris', 'aspirasis'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi'      => 'required|string|max:255',
            'ket'         => 'required|string',
            'foto'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengaduan', $nama_file, 'public');
        }

        Aspirasi::create([
            'user_id'     => Auth::id(),
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'foto'        => $path,
            'status'      => 'Menunggu',
        ]);

        return back()->with('success', 'Pengaduan berhasil terkirim! Tim sarana akan segera mengecek.');
    }

    public function updateFeedback(Request $request, $id)
{
    $request->validate(['feedback_siswa' => 'required|string']);
    
    $aspirasi = Aspirasi::findOrFail($id);
    $aspirasi->update([
        'feedback_siswa' => $request->feedback_siswa
    ]);

    return back()->with('success', 'Terima kasih atas feedback Anda!');
}
}