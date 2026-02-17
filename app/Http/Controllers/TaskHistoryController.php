<?php

namespace App\Http\Controllers;

use App\Services\Contract\TaskHistoryContract;
use Illuminate\Http\Request;

class TaskHistoryController extends Controller
{
    public function __construct(
        protected TaskHistoryContract $taskHistoryContract
    ) {}

    public function index(Request $request)
    {
        $tasks = $this->taskHistoryContract->index($request);

        return view('task-history.index', compact('tasks'));
    }

    public function details(int $taskId)
    {

    }
}
