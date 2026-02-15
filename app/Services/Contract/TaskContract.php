<?php

namespace App\Services\Contract;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;


interface TaskContract
{
    public function list(): Collection;
    public function store(array $data): JsonResponse;

    public function activeUser(): Collection;

    public function detail($id): object;

}
