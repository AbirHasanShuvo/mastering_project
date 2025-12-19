<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menuses';
    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'order',
        'is_active'

    ];

    // public function subMenus()
    // {
    //     return $this->hasMany(Menus::class, 'parent_id', 'id');
    // }

    // public function menu()
    // {
    //     return $this->belongsTo(Menus::class, 'parent_id', 'id');
    // }

    public function children()
    {
        return $this->hasMany(Menus::class, 'parent_id')
            ->where('is_active', 1)
            ->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Menus::class, 'parent_id');
    }
}
