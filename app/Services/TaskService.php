<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Enums\UserStatus;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use App\Services\Contract\TaskContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskService implements TaskContract
{
    public function index(?int $status = null): array
    {
        $user = auth()->user();
        $isEmployee = $user->role->isEmployee();

        $tasksQuery = Task::with(['user', 'creator']);
        if ($isEmployee) {
            $tasksQuery->where('user_id', $user->id);
        }

        if (in_array($status, [1, 2, 3])) {
            $tasksQuery->where('status', $status);
        }

        $tasks = $tasksQuery->orderByDesc('id')->get();

        $statsQuery = Task::query();
        if ($isEmployee) {
            $statsQuery->where('user_id', $user->id);
        }

        $stats = [
            'total'       => (clone $statsQuery)->count(),
            'pending'     => (clone $statsQuery)->where('status', 1)->count(),
            'in_progress' => (clone $statsQuery)->where('status', 2)->count(),
            'done'        => (clone $statsQuery)->where('status', 3)->count(),
        ];

        $users = $isEmployee
            ? User::where('id', $user->id)->get()
            : User::where('status', UserStatus::Active->value)->get();

        return compact('tasks', 'stats', 'users');
    }

    public function store(array $data): Task
    {
        return Task::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'status'      => $data['status'],
            'user_id'     => $data['user_id'] ?? null,
            'end_date'    => $data['end_date'] ?? null,
            'created_by'  => auth()->id(),
        ]);
    }
    public function update(int $id, array $data): bool
    {
        $task = Task::find($id);
        if (!$task) return false;

        $task->update($data);
        return true;
    }

    public function detail(int $id): Task
    {
        return Task::with(['user', 'creator', 'comments'])->findOrFail($id);
    }

    public function updateStatus(Task $task, int $status): bool
    {
        return $task->update([
            'status' => TaskStatus::from($status),
        ]);
    }

    public function edit(int $id): array
    {
        $task = Task::findOrFail($id);
        $users = User::all();

        return compact('task', 'users');
    }

    public function destroy(int $id): bool
    {
        return Task::destroy($id);
    }

    public function comment(array $data, int $id): TaskComment
    {
        return TaskComment::create([
            'task_id' => $id,
            'user_id' => Auth::id(),
            'date' => Carbon::now()->format('Y-m-d'),
            'comment' => $data['comment'],
        ]);
    }

}
