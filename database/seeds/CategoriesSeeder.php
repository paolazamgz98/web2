<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = array(
            ['id' => 1, 'name' => 'Económicos'],
            ['id' => 2, 'name' => 'Compactos'],
            ['id' => 3, 'name' => 'Mediano'],
            ['id' => 4, 'name' => 'Grande'],
            ['id' => 5, 'name' => 'Lujo'],
        );

        DB::table('categories')->insert($categories);
    }
}
