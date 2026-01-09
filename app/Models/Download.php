<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'download';
    protected $primaryKey = 'id_download';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'nama_file',
        'tgl_posting',
        'hits'
    ];
}
