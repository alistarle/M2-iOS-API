<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Setup OAuth client
        DB::table('oauth_clients')->insert([
            'name' => 'Laravel Password Grant Client',
            'secret' => 'W4YxTv53aOt6aC5iXqGfxDoJw9ZKmfyRiQxYK3iZ',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);


        $this->call(UserTableSeeder::class);
        $this->call(SessionTableSeeder::class);
        $this->call(RateTableSeeder::class);
    }
}
