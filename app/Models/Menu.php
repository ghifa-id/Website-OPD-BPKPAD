<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;
    protected $fillable = [
        'id_parent',
        'nama_menu',
        'link',
        'aktif',
        'position',
        'urutan'
    ];


    public function parent()
    {
        return $this->belongsTo(Menu::class, 'id_parent');
    }
    // Scope untuk top menu
    public function scopeTopMenu($query)
    {
        return $query->where('position', 'Top')->orderBy('urutan', 'ASC');
    }

    public function scopeBottomMenu($query)
    {
        return $query->where('id_parent', 0)->where('position', 'Bottom')->where('aktif', 'Ya')->orderBy('urutan', 'ASC');
    }

    public function scopeMenuWebsite($query)
    {
        return $query->orderBy('urutan');
    }

    public function scopeMenuUtama($query)
    {
        return $query->where(function ($q) {
            $q->where('id_parent', 0)->orWhere('link', '#');
        })->orderBy('urutan');
    }

    public function groupMenu()
    {
        return $this->belongsTo(Menu::class, 'id_parent');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'id_parent')->where('aktif', 'Ya')->orderBy('urutan', 'asc');
    }
}
