<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // Nama tabel

    protected $primaryKey = 'id_username';
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'email',
        'no_telp',
        'foto',
        'level',
        'blokir',
        'id_session'
    ];

    protected $hidden = [
        'password',
    ];

    // Override default username untuk autentikasi
    public function getAuthIdentifierName()
    {
        return 'username'; // Ganti dengan nama kolom id_user
    }
}
