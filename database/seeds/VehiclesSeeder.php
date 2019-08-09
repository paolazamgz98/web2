<?php

use Illuminate\Database\Seeder;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->truncate();

        $users = array(
            ['name' => 'Spark', 'category_id' => 1, 'model' => 'Chevrolet', 'color' => 'Rojo', 'price' => 17.5, 'image_url' => 'https://dqd8jwav9pcsr.cloudfront.net/media/images/uv/7efff867-b3ea-463d-8e36-c155f2cd9578/0b424854-9942-4307-ac42-4d8c681ed523/65686b0c-ce82-4933-aa5e-238e84636d9e.jpg' ],
            ['name' => 'Gol', 'category_id' => 1, 'model' => 'Volkswagen', 'color' => 'Negro', 'price' => 17 , 'image_url' => 'http://www.todoautos.com.pe/attachments/f51/44221d1297218542t-vendo-vw-gol-2006-negro-img_0106.jpg'],
            ['name' => 'Accent', 'category_id' => 2, 'model' => 'Hyundai', 'color' => 'Gris', 'price' => 21, 'image_url' => 'https://imganuncios.mitula.net/web/hyundai_accent_1_6_2013_6060135437604045725.jpg'],
            ['name' => 'Toledo', 'category_id' => 3, 'model' => 'Seat', 'color' => 'Blanco', 'price' => 25.5, 'image_url' => 'https://i1.wp.com/www.buscocochecanarias.com/wp-content/uploads/2017/11/10_Seat_Toledo_TSI_12-cc_2015_Blanco_buscocochecanarias_compraventa.jpg?zoom=2&resize=798%2C466' ],
            ['name' => 'Jetta', 'category_id' => 4, 'model' => 'Volkswagen', 'color' => 'Rojo', 'price' => 31, 'image_url' => 'https://http2.mlstatic.com/volkswagen-jetta-comfortline-std2016-D_NQ_NP_849198-MLM31372616659_072019-Q.webp' ],
            ['name' => 'Camry', 'category_id' => 5, 'model' => 'Toyota', 'color' => 'Negro', 'price' => 36, 'image_url' => 'https://www.lapulga.com.do/f/5908563-1.jpg' ],
        );

        DB::table('vehicles')->insert($users);
    }
}
