<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlist';
    protected $primaryKey = 'id_playlist';
    public $timestamps = false;

    protected $fillable = [
        'jdl_playlist',
        'username',
        'playlist_seo',
        'video_seo', // Pastikan ini ada
        'gbr_playlist',
        'aktif',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'id_playlist');
    }
}
