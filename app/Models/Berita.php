<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Komentar;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'sub_judul',
        'judul_seo',
        'isi_berita',
        'gambar',
        'keterangan_gambar',
        'hari',
        'tanggal',
        'jam',
        'youtube',
        'utama',
        'id_kategori',
        'username',
        'tag',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_berita', 'id_berita');
    }

public function likes()
{
    return $this->hasMany(BeritaLike::class, 'berita_id', 'id_berita');
}

public function dislikes()
{
    return $this->hasMany(BeritaLike::class)->where('tipe', 'dislike');
}

}
