<?php

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::create([
            'sessionDate' => '2017-03-25',
            'begin' => '11:00',
            'end' => '12:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => 24,
            'description' => 'Ceci est un description',
            'rate' => 4,
            'monitor_id' => 1,
            'student_id' => 1,
            'creator_id' => 1,
            'status' => 4,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '11:00',
            'end' => '12:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => null,
            'creator_id' => 1,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '11:00',
            'end' => '12:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => null,
            'student_id' => 1,
            'creator_id' => 3,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '11:00',
            'end' => '13:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => 1,
            'creator_id' => 1,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '09:00',
            'end' => '10:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => 1,
            'creator_id' => 1,
            'status' => 2,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '09:00',
            'end' => '10:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => 1,
            'creator_id' => 1,
            'status' => 3,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '11:00',
            'end' => '12:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => null,
            'creator_id' => 1,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '11:00',
            'end' => '12:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => null,
            'creator_id' => 1,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        Session::create([
            'sessionDate' => '2017-03-26',
            'begin' => '11:00',
            'end' => '12:00',
            'departure' => '47.9167,1.9',
            'arrival' => '47.9167,1.9',
            'distance' => null,
            'description' => null,
            'rate' => null,
            'monitor_id' => 1,
            'student_id' => null,
            'creator_id' => 1,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

    }
}
