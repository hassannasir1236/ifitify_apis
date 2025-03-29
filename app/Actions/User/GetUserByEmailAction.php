<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\UserRepository;

class GetUserByEmailAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(string $email): User | null
    {
        return $this->userRepository->getUserByEmail($email);
    }
}
