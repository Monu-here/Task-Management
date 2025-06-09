<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'task_name' => 'required|max:255',
            'description' => 'required',

        ], [
            'project_id.required' => 'Select project ',
            'task_name.required' => 'Task name is required',
            'description.required' => 'Description is required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }
        $data = new Task();
        $data->project_id = $request->project_id;
        $data->task_name = $request->task_name;
        $data->description = $request->description;
        $data->uuid = \Str::random(20);
        $data->save();
        return redirect()->back()->with('success', 'Task added successfully.');
    }
    public function updateTask(Request $request, $uuid)
    {
        $data = Task::where('uuid', $uuid)->first();
        if (!$data) {
            return redirect()->back()->with('message', 'No Task found');
        }
        $data->project_id = $request->project_id;
        $data->task_name = $request->task_name;
        $data->description = $request->description;
        $data->uuid = \Str::random(20);
        $data->save();
        return redirect()->back()->with('success', 'Task update successfully.');
    }
    public function statusUpdate(Request $request, $uuid)
    {
        $data = Task::where('uuid', $uuid)->first();
        if (!$data) {
            return redirect()->back()->with('message', 'No Task found');
        }
        $data->status = $request->status;
        $data->save();
        return redirect()->back()->with('success', 'Task status successfully.');
    }
    public function delete($uuid)
    {
        $data = DB::table('tasks')->where('uuid', $uuid)->first();
        if (!$data) {
            return redirect()->back()->with('message', 'No project found');
        }
        DB::table('tasks')->where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Task delete successfully.');
    }
}
