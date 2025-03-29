<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\UserRepository;

class CreateNewUserAction
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function execute(array $data) : User
    {   
        $data['email_verified_at'] = now();
        
        $user = $this->userRepository->create($data);
        return $user;
    }
}