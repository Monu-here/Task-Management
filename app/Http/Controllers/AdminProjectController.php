<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\CompanyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('company_id', auth()->user()->company_id)->with('company')->get();
        $companies = CompanyModel::all();
        return view('dashboard.projects.index', compact('projects', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string',
        ]);

        $companyId = auth()->user()->company_id;

        Project::create([
            'name' => $request->name,
            'color_code' => $request->color_code,
            'company_id' => $companyId,
            'uuid' => Str::uuid(),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);



        $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required|string',
        ]);

        $project->update([
            'name' => $request->name,
            'color_code' => $request->color_code,
            'company_id' => auth()->user()->company_id,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully');
    }
}
