<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'jabatan_pegawai_id',
        'pegawai_id',
        'lama_kontrak',
    ];
    public function jabatan_pegawai ()
    {
        return $this->belongsTo(JabatanPegawai::class);
    }
    public function pegawai ()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
