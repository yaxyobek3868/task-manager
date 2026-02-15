<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Models\Task;
use App\Models\User;
use App\Services\Contract\TaskContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class TaskService implements TaskContract
{
    public function list(): Collection
    {
       return Task::all();
    }

    public function activeUser(): Collection
    {
        return User::where('status', UserStatus::Active)->get();
    }

    public function store(array $data): JsonResponse
    {
        try {
            Task::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Task Created Successfully'
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function detail($id): Task
    {
        return Task::findOrFail($id);
    }

}
