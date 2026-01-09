<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Transparasi extends Model
{
    protected $table = 'transparasi';
    protected $primaryKey = 'id_transparasi';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'nama_file',
        'ket',
        'tgl_posting',
        'hits',
        'id_kat'
    ];
}
