<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::whereHas('projects', function($query) {
            $query->where('company_id', auth()->user()->company_id);
        })->with('projects')->orderBy('created_at', 'desc')->get();
        $projects = Project::where('company_id', auth()->user()->company_id)->get();
        return view('dashboard.tasks.index', compact('tasks', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        Task::create([
            'task_name' => $request->task_name,
            'project_id' => $request->project_id,
            'description' => $request->description,
            'status' => $request->status,
            'uuid' => Str::uuid(),
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'task_name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        $task->update([
            'task_name' => $request->task_name,
            'project_id' => $request->project_id,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully');
    }
}
