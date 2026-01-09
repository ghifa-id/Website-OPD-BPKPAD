<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_user_pajak extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'master_user_pajak';

    /**
     * Kunci utama tabel.
     *
     * @var string
     */
    protected $primaryKey = 'nip';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Tipe data kunci utama.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nip',
        'nama_pegawai',
        'password',
        'jabatan',
        'id_role_user',
        'status_user'
    ];

    /**
     * Kolom yang harus disembunyikan dari array atau JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casting tipe data untuk atribut tertentu.
     *
     * @var array
     */
    protected $casts = [
        'status_user' => 'boolean',
    ];

    /**
     * Relasi ke model MasterRoleUser (jika ada)
     */
    public function role()
    {
        return $this->belongsTo(Master_role_user::class, 'id_role_user', 'id_role_user');
    }
}