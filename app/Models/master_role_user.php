<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_role_user extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'master_role_user';

    /**
     * Kunci utama tabel.
     *
     * @var string
     */
    protected $primaryKey = 'id_role_user';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama_role',
        'allow_create',
        'allow_edit', 
        'allow_delete'
    ];

    /**
     * Kolom yang harus disembunyikan dari array atau JSON.
     *
     * @var array
     */
    protected $hidden = [
        // Tidak ada kolom yang perlu disembunyikan
    ];

    /**
     * Casting tipe data untuk atribut tertentu.
     *
     * @var array
     */
    protected $casts = [
        // Tidak perlu casting khusus
    ];

    /**
     * Relasi ke model MasterUserPajak
     */
    public function users()
    {
        return $this->hasMany(master_user_pajak::class, 'id_role_user', 'id_role_user');
    }
}