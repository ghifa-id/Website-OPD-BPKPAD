<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Berita;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $fillable = ['id_berita', 'nama_pengguna', 'email', 'isi_komentar'];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita', 'id_berita');
    }
}
