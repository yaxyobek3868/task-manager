<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\TaskStoreRequest;
use App\Services\Contract\TaskContract;
use Illuminate\Http\JsonResponse;

class TaskController  extends Controller
{
    public function __construct(
        protected TaskContract $taskContract
    ) {}

    public function index() {

        $tasks = $this->taskContract->list();
        $users = $this->taskContract->activeUser();

        return view('tasks.index', compact('tasks', 'users'));
    }

    public function store(TaskStoreRequest $request): JsonResponse
    {
        return $this->taskContract->store($request->validated());
    }


    public function detail(string $id)
    {
        $task = $this->taskContract->detail($id);

        return view('tasks.detail', compact('task'));
    }

}
