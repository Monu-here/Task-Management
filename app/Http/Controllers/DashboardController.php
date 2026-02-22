<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\CompanyModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $companyId = $user->company_id;
        $totalUsers = User::where('company_id', $companyId)->count();
        $totalProjects = Project::where('company_id', $companyId)->count();
        $totalTasks = Task::whereHas('projects', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->count();

        return view('dashboard.index', compact('totalUsers', 'totalProjects', 'totalTasks'));
    }
}
