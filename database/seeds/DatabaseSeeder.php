<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\User::class)->create();

        factory(\App\Need::class)->create(['title' => 'Einkauf Essen', 'lat' => 47.46152, 'lng' => 9.04552, 'user_id' => $user]);
        factory(\App\Need::class)->create(['lat' => 47.46222, 'lng' => 8.99763, 'user_id' => $user]);
        factory(\App\Need::class)->create(['lat' => 47.449350, 'lng' => 9.049850, 'user_id' => $user]);
        factory(\App\Need::class)->create(['lat' => 47.376888, 'lng' => 8.541694]);
        factory(\App\Need::class)->create(['lat' => 46.947975, 'lng' => 7.447447]);
    }
}
