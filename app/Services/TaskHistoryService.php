<?php

namespace App\Services;

use App\Services\Contract\TaskHistoryContract;

class TaskHistoryService implements TaskHistoryContract
{

    public function index()
    {
        return view('task-history.index');
    }

    public function detail( string $id)
    {
        return view('task-history.detail');
    }
}
