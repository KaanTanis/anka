<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Room;
use App\Models\RoomFeature;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => env('mail_from_address'),
            'password' => Hash::make('admin'),
            'name' => 'Admin'
        ]);
    }
}
