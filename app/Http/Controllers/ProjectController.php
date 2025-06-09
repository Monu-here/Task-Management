<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'color_code' => 'required',
            ], [
                'name.required' => 'Name is required',
                'color_code.required' => 'Color Code is required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }
            $data = new Project();
            $data->name = $request->name;
            $data->color_code = $request->color_code;
            $data->uuid = \Str::random(20);
            $data->save();
            return redirect()->back()->with('success', 'Project added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request,  $uuid)
    {
        $data = Project::where('uuid', $uuid)->first();
        if (!$data) {
            return redirect()->back()->with('message', 'No project found');
        }
        $data->name = $request->name;
        $data->color_code = $request->color_code;
        $data->uuid = \Str::random(20);
        $data->save();
        return redirect()->back()->with('success', 'Project update successfully.');
    }
    public function delete($uuid)
    {
        $data = DB::table('projects')->where('uuid', $uuid)->first();
        if (!$data) {
            return redirect()->back()->with('message', 'No project found');
        }
        DB::table('projects')->where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Project delete successfully.');
    }
}
