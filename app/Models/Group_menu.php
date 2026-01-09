<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class group_menu extends Model
{
    protected $table = 'group_menu';
    protected $fillable = ['nama_group_menu'];

    public function menuList()
    {
        return $this->hasMany(group_menu_list::class, 'id_group_menu');
    }
}
