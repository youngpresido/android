<?php

use Illuminate\Database\Seeder;

class AndroidApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Androidapi::class,30)->create();
    }
}
