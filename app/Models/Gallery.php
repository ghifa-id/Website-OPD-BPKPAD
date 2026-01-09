<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id_gallery';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'id_album',
        'jdl_gallery',
        'gallery_seo',
        'keterangan',
        'gbr_gallery',
        'slider',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'id_album', 'id_album');
    }
}
