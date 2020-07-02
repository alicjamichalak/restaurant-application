<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = [
          1 => [
              'menu_name' => 'Pierogi ruskie',
              'menu_preparation_time' => '00:15:00',
              'menu_price' => 15.00,
              'menu_food_type' => 1,
          ],
        ];

    }
}
