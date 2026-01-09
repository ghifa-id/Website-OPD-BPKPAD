<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'jabatan_id';
    protected $fillable = ['nama_jabatan', 'tipe_jabatan'];
    public $timestamps = false;

    public function pejabat()
    {
        return $this->hasMany(Pejabat::class, 'jabatan_id', 'jabatan_id');
    }
}
