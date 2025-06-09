<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $projects = DB::table('projects')->orderBy('created_at', 'desc')->get();
        $tasks = Task::with('projects')->orderBy('created_at', 'desc')->get();
        return view('welcome',compact('projects','tasks'));
    }
}
