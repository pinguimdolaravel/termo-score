<?php

namespace App\Actions;

use App\Models\User;

class RegisterUser extends Action
{
    /**
     * @param string|null $name
     * @param string|null $email
     * @param string|null $password
     * @return User
     */
    public function handle(
        ?string $name = null,
        ?string $email = null,
        ?string $password = null,
    ): User
    {
        return User::query()->create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
        ]);
    }
}

//RegisterUser::run(
//    name: 'Rafael',
//    email: 'rafael@dolaravel.com',
//    password: 'jeremias'
//);
////
//
//(new RegisterUser(name: 'Rafael', email: 'rafael@dolaravel.com', password: 'jeremias'))
//    ->execute();
