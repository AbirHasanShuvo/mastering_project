<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menus::whereNull('parent_id',)->where('is_active', 1)->orderby('order')->with('children')->get();

        return view('welcome', compact('menus'));
    }
}
