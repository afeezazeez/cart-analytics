<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Interfaces\IUserRepository;
use App\Models\User;

class AuthService
{

    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Login user with password
     *
     * @param array $request
     * @return array
     * @throws ClientErrorException
     */
    public function login(array $request): array
    {
        $user = $this->userRepository->findByEmail($request['email']);

        if (!password_verify($request['password'], $user->password)) {
            throw new ClientErrorException('Incorrect password!');
        }

        $token = $user->createToken('MWL')->accessToken;

        if ($token) {
            return [
                'token' => $token,
                'user' => [
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ];
        }

        throw new ClientErrorException("Error logging in. Try again!");

    }


    /**
     * Log out
     *
     * @return void
     */
    public function logout($user): void
    {
        $user->token()->revoke();
    }


}
