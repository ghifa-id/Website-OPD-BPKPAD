<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalamanStatis extends Model
{

    protected $table = 'halaman_statis';
    protected $primaryKey = 'id_halaman';

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;


    protected $fillable = [
        'judul',
        'judul_seo',
        'isi_halaman',
        'tgl_posting',
        'gambar',
        'username',
        'dibaca',
        'jam',
        'hari',
    ];
}
