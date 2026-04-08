<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi'; 
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
        'foto', 
        'status',
        'feedback'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}