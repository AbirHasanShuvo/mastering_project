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

    public function editMenu($id)
    {

        $currentMenu = Menus::find($id);


        return view(' menu.menu_edit', [
            'menus' => Menus::get(['id', 'title'],),
            'currentMenu' => $currentMenu
        ]);
    }

    // public function updateMenu(Request $request)
    // {

    //     $menu = Menus::find($request->id);

    //     $menu->title = $request->title;
    //     $menu->url = $request->url;
    //     $menu->order = $request->order;
    //     $menu->is_active = $request->is_active;
    //     $menu->parent_id = $request->parent_id;

    //     $menu->save();
    //     //    $menu->order=

    // }

    //new update method

    public function updateMenu(Request $request, $id)  // <--- include $id
    {
        $menu = Menus::findOrFail($id);

        $menu->update([
            'title' => $request->title,
            'url' => $request->url,
            'order' => $request->order,
            'is_active' => $request->is_active ?? 0,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('getAllMenu')->with('success', 'Menu updated successfully');
    }

    public function deleteMenu($id)
    {
        $menu = Menus::find($id);

        $menu->delete();

        return redirect()->route('getAllMenu');
    }
}
