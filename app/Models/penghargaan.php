<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penghargaan extends Model
{
    protected $table = 'penghargaan';
    protected $primaryKey = 'id_penghargaan';
    public $timestamps = false;
    protected $fillable = [
        'judul',
        'deskripsi',
        'pemberi',
        'tahun',
        'tingkat',
        'gambar',
        'tgl_posting',
        'username',
        'dibaca',
        'jam',
    ];
}
