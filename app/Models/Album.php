<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    protected $table = 'album';
    protected $primaryKey = 'id_album';
    public $timestamps = false;

    protected $fillable = [
        'jdl_album',
        'album_seo',
        'keterangan',
        'gbr_album',
        'aktif',
        'hits_album',
        'tgl_posting',
        'jam',
        'hari',
        'username',
        'tgl_kegiatan',
        'tempat'
    ];
}
