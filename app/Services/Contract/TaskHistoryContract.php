<?php

namespace App\Services\Contract;
interface TaskHistoryContract
{
    public function index();

    public function detail( string $id);

}
