<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidDaftarInfo extends Model
{
    // Atur koneksi database yang berbeda
    protected $connection = 'ppid';
    protected $table = 'tb_daftarinfo';

    // Jika tabel tidak menggunakan primary key 'id', atur di sini:
    // protected $primaryKey = 'id'; // contoh jika menggunakan 'id', atau ganti sesuai nama primary key

    // Jika tabel tidak memiliki timestamps, atur:
    public $timestamps = false;

    // Definisikan field yang dapat diisi secara massal
    protected $fillable = [
        'judul',
        'id_skpd',
        'id_kat',
        'tgl',
        'tahun',
        'file',
        'url'
    ];
}
