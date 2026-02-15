<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
use App\Http\Requests\UserStatusRequest;
use App\Models\User;
use App\Services\Contract\UserContract;


class UserController extends Controller
{
    public function __construct(
        protected UserContract  $userContract
    ) {}

    public function index(?string $search = null)
    {
        User::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orderByDesc('id')
            ->get();

        return view('users.index');
    }


    public function changeRole(UserRoleRequest $request, User $user)
    {
         $user->update(['role' => $request->validated()['role']]);


    }

    public function changeStatus(UserStatusRequest $request, User $user)
    {
        $user->update(['status' => $request->validated()['status']]);


    }

}
