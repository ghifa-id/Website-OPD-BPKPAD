<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    protected $table = 'identitas';
    protected $primaryKey = 'id_identitas';
    protected $fillable = ['nama_website', 'email', 'no_telp', 'facebook', 'keterangan'];
    public $timestamps = false;
}
