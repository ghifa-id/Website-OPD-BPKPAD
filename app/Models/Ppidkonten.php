<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppidkonten extends Model
{
    protected $table = 'ppidkonten';
    protected $primaryKey = 'id_ppidkonten';
    public $timestamps = false;

    protected $fillable = [
        'tgl_posting',
        'hits',
        'nama_file',
        'jenis',
        'id_kat'
    ];
}
