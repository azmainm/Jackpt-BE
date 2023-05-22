<?php

namespace Tests;

use App\Domains\User\Models\User;
use App\Domains\User\Repositories\UserRepository;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createUser(): User
    {
        $faker = Factory::create();

        return (new UserRepository())->create([
            'name' => $faker->name(),
            'email' => 'test@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }

    protected function token()
    {
        ['data' => $data] = $this->post(route('user.login'), ['email' => 'test@gmail.com', 'password' => '123456']);

        return $data['token'];
    }

    protected function createToken(): array
    {
        return ['Authorization' => 'Bearer '.$this->token(), 'Accept' => 'application/json'];
    }
}
