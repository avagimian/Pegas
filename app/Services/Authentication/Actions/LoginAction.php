<?php

namespace App\Services\Authentication\Actions;

use App\Exceptions\UserNotFoundException;
use App\Repositories\Read\PassportClient\PassportClientReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\Authentication\Dtos\LoginDto;
use Illuminate\Support\Facades\Http;

class LoginAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository,
        protected PassportClientReadRepositoryInterface $passportClientReadRepository
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function run(LoginDto $dto)
    {
        $user = $this->userReadRepository->getByEmail($dto->email);

        $oClientId = config('passport.password_grant_client.id');
        $oClient = $this->passportClientReadRepository->getById($oClientId);

        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $dto->email,
            'password' => $dto->password,
            'scope' => '*',
        ]);

        $data = json_decode($response->getBody()->getContents());
        $data->user = $user;

        if (property_exists($data, 'errors')) {
            throw new UserNotFoundException();
        }

        return $data;
    }
}
