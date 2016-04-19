<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\OauthClient;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        OauthClient::truncate();

        factory(OauthClient::class)->create([
            'id' => 'appid1',
            'secret' => 'secret',
            'name' => 'AngularApp',
        ]);
    }
}