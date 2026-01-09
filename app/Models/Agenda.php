<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{

    protected $table = 'agenda'; // jika nama tabel bukan jamak dari nama model
    protected $primaryKey = 'id_agenda'; // karena bukan 'id'

    public $timestamps = false; // karena tidak ada created_at, updated_at

    protected $fillable = [
        'tema',
        'tema_seo',
        'isi_agenda',
        'tempat',
        'pengirim',
        'gambar',
        'tgl_mulai',
        'tgl_selesai',
        'tgl_posting',
        'jam',
        'dibaca',
        'username'
    ];
}
