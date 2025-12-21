<?php

namespace Database\Seeders;

use App\Models\Menus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menus::truncate();

        $home = Menus::create([
            'title' => 'Home',
            'url' => '/',
            'order' => 1
        ]);

        $products = Menus::create([
            'title' => 'Products',
            'order' => 2
        ]);

        $menuss = Menus::create([
            'title' => 'Menu',
            'order' => 4,
            'url' => '/menu'
        ]);

        Menus::create([
            'title' => 'Add menu',
            'url' => '/add_menu',
            'parent_id' => $menuss->id
        ]);
        Menus::create([
            'title' => 'Mobile',
            'url' => '/products/mobile',
            'parent_id' => $products->id,
            'order' => 1
        ]);

        Menus::create([
            'title' => 'Laptop',
            'url' => '/products/laptop',
            'parent_id' => $products->id,
            'order' => 2
        ]);

        $services = Menus::create([
            'title' => 'Services',
            'order' => 3
        ]);

        Menus::create([
            'title' => 'Web Development',
            'url' => '/services/web',
            'parent_id' => $services->id
        ]);

        Menus::create([
            'title' => 'App Development',
            'url' => '/services/app',
            'parent_id' => $services->id
        ]);
    }
}
