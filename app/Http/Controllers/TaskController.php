<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Task;
use App\Services\Contract\TaskContract;

class TaskController extends Controller
{
    public function __construct(protected TaskContract $taskContract) {}

    public function index(?int $status = null)
    {
        $data = $this->taskContract->index($status);
        return view('tasks.index', $data);
    }

    public function store(TaskStoreRequest $request)
    {
        $this->taskContract->store($request->validated());
        return redirect()->route('tasks.index')
            ->with('success', 'Vazifa yaratildi');
    }

    public function detail(int $id)
    {
        $task = $this->taskContract->detail($id);

        return view('tasks.detail', compact('task'));
    }

    public function edit(int $id)
    {
        $data = $this->taskContract->edit($id);
        return view('tasks.edit', $data);
    }

    public function updateStatus(UpdateStatusRequest $request, Task $task)
    {
        $this->taskContract->updateStatus($task, (int) $request->status);
        return redirect()->back()->with('success', 'Vazifa holati yangilandi.');
    }

    public function destroy(int $id)
    {
        $deleted = $this->taskContract->destroy($id);

        if ($deleted) {
            return redirect()->route('tasks.index')
                ->with('success', 'Vazifa muvaffaqiyatli o‘chirildi.');
        }

        return redirect()->route('tasks.index')
            ->with('error', 'Vazifa topilmadi yoki o‘chirib bo‘lmadi.');
    }

    public function comment(CommentRequest $request, int $id)
    {
        $this->taskContract->comment($request->validated(), $id);
        return redirect()->back()->with('success', 'Comment added!');
    }

    public function update(TaskStoreRequest $request, int $id)
    {
        $data = $request->validated();

        $updated = $this->taskContract->update($id, $data);

        if ($updated) {
            return redirect()->route('tasks.detail', $id)
                ->with('success', 'Vazifa muvaffaqiyatli yangilandi.');
        }

        return redirect()->back()
            ->with('error', 'Vazifa yangilashda xatolik yuz berdi.');
    }


}
