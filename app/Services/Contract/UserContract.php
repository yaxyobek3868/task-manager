<?php

namespace App\Services\Contract;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRoleRequest;
use App\Http\Requests\UserStatusRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

interface UserContract
{
    public function index(?string $search = null);

    public function changeRole(UserRoleRequest $request, User $user);

    public function changeStatus(UserStatusRequest $request, User $user);
    public function update(UserRequest $request, User $user);
    public function destroy(User $user);

}
