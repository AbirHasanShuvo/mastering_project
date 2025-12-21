<?php

use App\Models\Menus;

function getSiderbarMenu()
{
    return Menus::whereNull('parent_id',)->where('is_active', 1)->orderby('order')->with('children')->get();
}
