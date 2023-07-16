<?php

namespace App\Services\Authentication\Actions;

use App\Models\User;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Services\Authentication\Dtos\RegisterDto;

class RegisterAction
{
    public function __construct(
        protected UserWriteRepositoryInterface $userWriteRepository
    ) {
    }

    public function run(RegisterDto $dto): void
    {
        $user = User::staticCreate($dto);

        $this->userWriteRepository->save($user);
    }
}
