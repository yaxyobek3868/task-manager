<?php

namespace App\Http\Controllers;


use App\Services\Contract\TaskHistoryContract;

class TaskHistoryController extends Controller
{
    public function __construct(
        protected TaskHistoryContract $taskHistoryContract
    ) {}

    public function index()
    {
        return view('task-history.index');
    }

    public function detail( string $id)
    {
        return view('task-history.detail');
    }

}
