<?php

namespace Database\Seeders;

use App\Domains\User\Repositories\UserRepository;
use function App\Helpers\randomString;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Tamanna', 'email' => 'tamanna@gmail.com'],
        ];
        foreach ($users as $user) {
            (new UserRepository())->create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('123456'),
                'status' => 'active',
                'secret_key' => randomString(10),
            ]);
        }
    }
}
