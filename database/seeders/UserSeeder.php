<?php

namespace Database\Seeders;

use App\Domains\User\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\randomString;

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
            ['name' => 'Foysal', 'email' => 'rahman@tikweb.com'],
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
