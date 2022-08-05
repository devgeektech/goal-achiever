<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $users = [
            ['name' => 'admin', 'email' => 'admin@email.com','email_verified_at' => '','password' => Hash::make('&@Bw2M'), 'remember_token' => '', 'role' => '1' ]
        ];
          
        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
