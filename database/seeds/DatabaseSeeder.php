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
        $user1 = factory(\App\User::class)->create([
            'name' => 'Marco Rieser',
            'email' => 'marco.rieser@jedesign.ch',
            'lat' => 47.46152,
            'lng' => 9.04552,
            'plz' => '9500',
            'city' => 'Wil SG',
            'password'=> Hash::make( '12345678')
        ]);
        $user2 = factory(\App\User::class)->create(['lat' => 47.449350, 'lng' => 9.049850]);
        $user3 = factory(\App\User::class)->create(['lat' => 47.376888, 'lng' => 8.541694]);
        $user4 = factory(\App\User::class)->create(['lat' => 46.947975, 'lng' => 7.447447]);

        factory(\App\Need::class)->create(['title' => 'Einkauf Essen', 'user_id' => $user1]);
        factory(\App\Need::class)->create(['user_id' => $user1]);
        factory(\App\Need::class)->create(['user_id' => $user2]);
        factory(\App\Need::class)->create(['user_id' => $user3]);
        factory(\App\Need::class)->create(['user_id' => $user4]);
    }
}
