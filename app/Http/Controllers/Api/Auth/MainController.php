<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Repositories\UserRepository;

/**
 * Class MainController
 *
 * @package App\Http\Controllers\Api\Auth
 */
class MainController extends BaseController
{
    /**
     * @param LoginRequest $request
     * @param UserRepository $userRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(
        LoginRequest $request,
        UserRepository $userRepo
    )
    {
        $user = $userRepo->getByEmail(
            $request->input('email')
        );

        if ($user === null) {
            return $this->respondWithError('Пользователь с таким E-mail не зарегистрирован.');
        }

        if (!auth()->attempt([
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ])) {
            return $this->respondWithError('Не удалось авторизовать пользователя.');
        }

        return $this->respondWithSuccess([
            'token'     => auth()->user()->createToken('authToken')->accessToken
        ] , 'Вы успешно вошли в систему.');
    }
}
