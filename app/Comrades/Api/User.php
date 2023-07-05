<?php

namespace App\Comrades\Api;

use App\Models\TempUser;
use App\Models\User;

class UserApi
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public static function createNewUser(array $data)
    {
        $data_new['email'] = $data['email'];
        $data_new['verification_code'] = $data['verification_code'];
        $data_new['password'] = encrypt($data['password']);

        TempUser::where('email', $data_new['email'])->delete();

        $user = TempUser::create($data_new);

        unset($user['password']);

        return $user;
    }
}
