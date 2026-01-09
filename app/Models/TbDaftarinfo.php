<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbDaftarinfo extends Model
{
    protected $connection = 'ppid';
    protected $table = 'tb_daftarinfo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_kat',
        'id_skpd',
        'id_upt',
        'id_regnag',
        'kd_bencana',
        'url',
        'judul',
        'tahun',
        'isi',
        'file',
        'type',
        'ukuran',
        'teks_file',
        'pj',
        'tgl',
        'tgl2',
        'entri',
        'hit',
        'aktif',
        'pesan'
    ];
}
