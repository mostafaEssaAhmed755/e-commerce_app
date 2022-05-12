<?php

namespace Database\Seeders;

use Modules\Products\Entities\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()->count(5)->create();
    }
}
