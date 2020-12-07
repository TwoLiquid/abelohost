<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class LoginRequest
 *
 * @package App\Http\Requests\Api\Auth
 */
class LoginRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'email'     => 'required|email|exists:users',
            'password'  => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'email.required'    => 'Необходимо ввести E-mail.',
            'email.email'       => 'Неверный формат E-mail\'а.',
            'email.exists'      => 'Пользователь с таким E-mail не найден.',
            'password.required' => 'Необходимо ввести пароль.',
            'password.string'   => 'Пароль должен быть строкой.',
        ];
    }
}
