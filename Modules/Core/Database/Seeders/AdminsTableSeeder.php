<?php

namespace Modules\Core\Database\Seeders;

use Modules\Core\Entities\Admin;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Admin::create([
            'name'     => $faker->name,
            'email'    => 'admin@admin.com',
            'password' => Hash::make('mdark755'),
        ]);
    }
}
