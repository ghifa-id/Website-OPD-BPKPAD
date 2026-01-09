<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk_hukum extends Model
{
    protected $table = 'produk_hukum';
    protected $primaryKey = 'id_produk_hukum';
    public $timestamps = false;

    protected $fillable = ['judul', 'ket', 'nama_file', 'tgl_posting', 'hits'];
}
