<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class announcement extends Model
{
    protected $table = 'announcement';
    protected $primaryKey = 'id_announcement';
    public $timestamps = false;
    protected $fillable = [
        'judul',
        'judul_seo',
        'perihal',
        'deskripsi_pengumuman',
        'deadline',
        'keterangan',
        'file_pendukung',
        'tanggal_posting',
        'dibaca',
        'username'
    ];
}
