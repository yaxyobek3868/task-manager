<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRoleRequest;
use App\Http\Requests\UserStatusRequest;

use App\Models\User;
use App\Services\Contract\UserContract;

class UserService implements UserContract
{
    public function index(?string $search = null): array
    {

        $users = User::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->orderByDesc('id')
            ->get();

        $stats = [
            'total' => User::count(),
            'active' => User::where('status', UserStatus::Active->value)->count(),
            'pending' => User::where('status', UserStatus::Pending->value)->count(),
        ];

        return compact('users', 'stats');
    }

    public function changeRole(UserRoleRequest $request, User $user): User
    {
        $user->update(['role' => $request->validated()['role']]);
        return $user;
    }

    public function changeStatus(UserStatusRequest $request, User $user): User
    {
        $user->update(['status' => $request->validated()['status']]);
        return $user;
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

}
