<?php

namespace App\Services;

use App\Http\Requests\UserRoleRequest;
use App\Models\User;
use App\Services\Contract\TaskContract;
use App\Services\Contract\UserContract;

class UserService implements UserContract
{
    public function index(?string $search = null)
    {

    }
    public function changeRole(UserRoleRequest $request, User $user)
    {

    }
    public function changeStatus(UserRoleRequest $request, User $user)
    {

    }
}
