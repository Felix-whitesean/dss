<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //This is the default menu for the different Items
        $menuItems = [
            ['name' => 'home','icon'=> 'i', 'status' => 1, 'item_owner' => 1],
            ['name' => 'configurations','icon'=> 'i', 'status' => 1, 'item_owner' => 1],
            ['name' => 'reviews and comments','icon'=> 'i', 'status' => 1, 'item_owner' => 1],
        ];

        // Insert data using the DB facade or your model
        foreach ($menuItems as $item) {
            DB::table('menus')->insert($item);
        }
    }
}
