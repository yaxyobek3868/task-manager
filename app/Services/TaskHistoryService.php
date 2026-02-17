<?php

namespace App\Services;

use App\Models\Task;
use App\Services\Contract\TaskHistoryContract;
use Illuminate\Http\Request;

class TaskHistoryService implements TaskHistoryContract
{
    public function index(Request $request)
    {
        $query = Task::with('user');

        $user = auth()->user();


        if ($user->role == 2) {
            $query->where('user_id', $user->id);
        }


        if ($request->filled('search')) {
            $search = $request->search;


            if ($user->role == 2) {
                $query->where('name', 'ILIKE', "%{$search}%");
            } else {

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'ILIKE', "%{$search}%");
                        });
                });
            }
        }

        if ($request->filled('status') && in_array($request->status, [1, 2, 3])) {
            $query->where('status', $request->status);
        }


        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        return $query->orderByDesc('id')->get();

    }


    public function detail($id)
    {
        return Task::with('user')->findOrFail($id);
    }
}
