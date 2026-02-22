<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $user = auth()->user();

        $tasksQuery = Task::with('projects')
            ->whereHas('projects', function ($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->orderBy('created_at', 'desc');

        if ($request->filled('project_id')) {
            $tasksQuery->where('project_id', $request->project_id);
        }

        if ($request->filled('status')) {
            $tasksQuery->where('status', $request->status);
        }

        $tasks = $tasksQuery->get();
        return view('welcome', compact('tasks'));
    }

    public function updateTaskStatus(Request $request, $uuid)
    {
        $user = auth()->user();

        $task = Task::where('uuid', $uuid)
            ->whereHas('projects', function ($query) use ($user) {
                $query->where('company_id', $user->company_id);
            })
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('home.home')->with('success', 'Task status updated successfully');
    }
}
