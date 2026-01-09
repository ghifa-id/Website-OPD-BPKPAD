<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepuasanPublik extends Model
{
    protected $table = 'survey_kepuasan';
    protected $fillable = [
        'nama',
        'email',
        'skor',
        'komentar',
        'informasi',
        'fitur'
    ];
}
