<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Dotenv\Validator;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // $menus = Menus::whereNull('parent_id',)->where('is_active', 1)->orderby('order')->with('children')->get();

        return view('dashboard');
    }

    public function add_menu()
    {

        return view('menu.menu', [
            'menus' => Menus::get(['id', 'title']),
        ]);
    }

    public function storeMenu(Request $request)
    {
        $menu = new Menus();

        $request->validate([
            'title' => 'required',
            'order' => 'required'
        ]);

        $menu->title = $request->title;
        $menu->url = $request->url;
        $menu->parent_id = $request->parent_id;
        $menu->order = $request->order;
        $menu->is_active = $request->is_active;

        $menu->save();
        return redirect()->route('dashboard');
    }

    public function getAllMenu()
    {
        return view('menu.menu_list', [
            'menus' => Menus::whereNull('parent_id')->get(['id', 'title', 'url', 'parent_id', 'order', 'is_active']),
        ]);
    }
}
