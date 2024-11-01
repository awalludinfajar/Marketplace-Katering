<?php

namespace Database\Seeders;

use App\Models\CategoryMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [[
            'nama' => 'Makanan Berat',
            'deskripsi' => 'deskripsi',
        ],[
            'nama' => 'Makanan Ringan',
            'deskripsi' => 'deskripsi',
        ],[
            'nama' => 'Kue Basah',
            'deskripsi' => 'deskripsi',
        ],[
            'nama' => 'Pastry',
            'deskripsi' => 'deskripsi',
        ],[
            'nama' => 'Buah buahan',
            'deskripsi' => 'deskripsi',
        ]];

        foreach ($categories as $category) {
            CategoryMenu::create($category);
        }
    }
}
