<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $projects = DB::table('projects')->orderBy('created_at', 'desc')->get();
        $tasksQuery = Task::with('projects')->orderBy('created_at', 'desc');
        if ($request->filled('project_id')) {
            $tasksQuery->where('project_id', $request->project_id);
        }

        if ($request->filled('status')) {
            $tasksQuery->where('status', $request->status);
        }
        $tasks = $tasksQuery->get();
        return view('welcome', compact('projects', 'tasks'));
    }
}
