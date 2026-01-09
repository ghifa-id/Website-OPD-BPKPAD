<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dokperenlitbang extends Model
{
    protected $table = 'dokperenlitbang';
    protected $primaryKey = 'id_dokperenlitbang';
    public $timestamps = false;
    protected $fillable = [
        'tgl_posting',
        'hits',
        'nama_file',
        'jenis',
        'cover_file',
        'tahun_dokumen'
    ];
}
