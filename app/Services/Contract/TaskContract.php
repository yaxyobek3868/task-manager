<?php

namespace App\Services\Contract;

use App\Models\Task;
use App\Models\TaskComment;

interface TaskContract
{

    public function index(?int $status): array;
    public function store(array $data): Task;
    public function detail(int $id): Task;
    public function updateStatus(Task $task, int $status): bool;
    public function update(int $id, array $data): bool;

    public function edit(int $id): array;
    public function destroy(int $id): bool;
    public function comment(array $data, int $id): TaskComment;
}
