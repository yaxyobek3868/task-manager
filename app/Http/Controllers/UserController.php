<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRoleRequest;
use App\Http\Requests\UserStatusRequest;
use App\Models\User;
use App\Services\Contract\UserContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserContract $userContract
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = $this->userContract->index($search);

        return view('users.index', $data);
    }

    public function changeRole(UserRoleRequest $request, User $user)
    {
        $this->userContract->changeRole($request, $user);
        return redirect()->back()->with('success', 'Roli o\'zgartirildi.');
    }

    public function changeStatus(UserStatusRequest $request, User $user)
    {
        $this->userContract->changeStatus($request, $user);
        return redirect()->back()->with('success', 'Holati o\'zgartirildi.');
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->userContract->update($request, $user);

        return redirect()->route('tasks.index')
            ->with('success', 'Foydalanuvchi yangilandi.');
    }

    public function destroy(User $user)
    {
        $this->userContract->destroy($user);

        return redirect()->route('tasks.index')
            ->with('success', 'Foydalanuvchi o‘chirildi.');
    }

}
