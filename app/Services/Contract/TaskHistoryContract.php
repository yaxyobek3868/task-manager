<?php

namespace App\Services\Contract;

use Illuminate\Http\Request;

interface TaskHistoryContract
{
    public function index(Request $request);
    public function detail( string $id);

}
