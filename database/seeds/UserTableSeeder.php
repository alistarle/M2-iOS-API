<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Victor Coutellier',
            'email' => 'alistarle@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0632591834',
            'address' => '1 rue de tours',
            'cp' => '45100',
            'city' => 'Orleans',
            'role_id' => '1',
            'role_type' => 'App\Models\Monitor',
            'price' => '12',
            'range_km' => '10',
            'avatarUrl' => 'http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'name' => 'Jean-Baptiste Piquer',
            'email' => 'jb.piquer@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0632591834',
            'address' => '3 rue moliere',
            'cp' => '45000',
            'city' => 'Orleans',
            'role_id' => '2',
            'role_type' => 'App\Models\Monitor',
            'price' => '30',
            'range_km' => '5',
            'avatarUrl' => 'http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'name' => 'Alexandre Astier',
            'email' => 'alex.astier@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0632591834',
            'address' => '100 boulevard suchet',
            'cp' => '75016',
            'city' => 'Paris',
            'role_id' => '1',
            'role_type' => 'App\Models\Student',
            'price' => '15',
            'range_km' => '20',
            'avatarUrl' => 'http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'name' => 'Vladimir Karasouloff',
            'email' => 'vladimir.karasouloff@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0632591834',
            'address' => '3 rue charles de coulomb',
            'cp' => '45100',
            'city' => 'Orleans',
            'role_id' => '2',
            'role_type' => 'App\Models\Student',
            'price' => '5',
            'range_km' => '100',
            'avatarUrl' => 'http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'name' => 'Julien Gauttier',
            'email' => 'julien.gauttier@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0632591834',
            'address' => '5 rue de tours',
            'cp' => '45100',
            'city' => 'Orleans',
            'role_id' => '3',
            'role_type' => 'App\Models\Student',
            'price' => '100',
            'range_km' => '1000',
            'avatarUrl' => 'http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('users')->insert([
            'name' => 'Johny Coutellier',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0632591834',
            'address' => '47 route d\'henrichemont',
            'cp' => '18110',
            'city' => 'Allogny',
            'role_id' => '4',
            'role_type' => 'App\Models\Student',
            'price' => '120',
            'range_km' => '1000',
            'avatarUrl' => 'http://jeanbaptiste.bayle.free.fr/AVATAR/grey_81618-default-avatar-200x200.jpg',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('students')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('students')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('students')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('students')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('monitors')->insert([
            'vehiculeBrand' => 'Opel',
            'vehiculeModel' => 'Zafira',
            'vehiculeYear' => 2016,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        DB::table('monitors')->insert([
            'vehiculeBrand' => 'Peugeot',
            'vehiculeModel' => '207',
            'vehiculeYear' => 2003,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

    }
}
