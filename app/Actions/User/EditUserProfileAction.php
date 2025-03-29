<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\UserRepository;

class EditUserProfileAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(User $user, array $data): bool
    {
        return $this->userRepository->update($user, $data);
    }
}
