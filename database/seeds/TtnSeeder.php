<?php

use Illuminate\Database\Seeder;

class TtnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ttn::class, 20)->create();
    }
}
