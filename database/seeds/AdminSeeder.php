<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kashif Saleem',
            'email' => 'darkcoder1996@gmail.com',
            'password' => bcrypt('error404')
        ]);
        //
    }
}
