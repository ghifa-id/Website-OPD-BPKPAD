<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id_video';
    public $timestamps = false;

    protected $fillable = [
        'id_playlist',
        'jdl_video',
        'username',
        'video_seo',
        'keterangan',
        'gbr_video',
        'video',
        'youtube', // Kolom untuk menyimpan ID YouTube
        'dilihat',
        'hari',
        'tanggal',
        'jam',
        'tagvid',
    ];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'id_playlist');
    }

    // Accessor untuk embed URL YouTube
    // app/Models/Video.php

    public function getYoutubeEmbedAttribute()
    {
        $url = $this->youtube;

        // Jika sudah format embed, langsung return
        if (str_contains($url, 'youtube.com/embed')) {
            return $url;
        }

        // Jika format watch
        if (str_contains($url, 'youtube.com/watch')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            return "https://www.youtube.com/embed/" . ($params['v'] ?? '');
        }

        // Jika format youtu.be
        if (str_contains($url, 'youtu.be')) {
            $videoId = last(explode('/', $url));
            return "https://www.youtube.com/embed/$videoId";
        }

        // Jika hanya ID video
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return "https://www.youtube.com/embed/$url";
        }

        return null; // Format tidak dikenali
    }
}
