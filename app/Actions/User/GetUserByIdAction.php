<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\UserRepository;

class GetUserByIdAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }
}
