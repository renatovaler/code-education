<?php

use Illuminate\Database\Seeder;

class OAuth2ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\CodeProject\Entities\OAuth2::truncate();
        factory(\CodeProject\Entities\OAuth2::class, 5)->create();
    }
}
