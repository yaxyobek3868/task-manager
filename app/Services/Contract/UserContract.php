<?php

namespace App\Services\Contract;

use App\Http\Requests\UserRoleRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

interface UserContract
{
    public function index(?string $search = null);

    public function changeRole(UserRoleRequest $request, User $user);

    public function changeStatus(UserRoleRequest $request, User $user);

}
