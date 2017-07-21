<?php

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => 1,
            'name' => 'Vasyl',
            'middlename' => 'Petrovych',
            'lastname' => 'Dinets',
            'phone' => '0669708707',
            'passport_id' => 'KO686651',
        ]);
        factory(App\Profile::class, 19)->create();
    }
}
