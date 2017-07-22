<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'vasyldinets@gmail.com',
            'password' => bcrypt('1'),
            'role' => 'user',
        ]);
        factory(App\User::class, 19)->create();
    }
}
