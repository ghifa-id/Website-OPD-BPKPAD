<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaLike extends Model
{
    protected $table = 'berita_like';

    protected $fillable = ['berita_id', 'tipe', 'ip_address'];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id', 'id_berita');
    }
}
