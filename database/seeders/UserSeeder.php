<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jon Routley',
            'email' => 'jroutley@element25.com',
            'password' => Hash::make('Rileys1850'),
            'level' => 'super',
        ]);

        //User::factory(10)->create();
    }
}
