<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class group_menu_list extends Model
{
    protected $table = 'group_menu_list';
    protected $fillable = ['id_group_menu', 'nama', 'link'];

    public function groupMenu()
    {
        return $this->belongsTo(group_menu::class, 'id_group_menu');
    }
}
