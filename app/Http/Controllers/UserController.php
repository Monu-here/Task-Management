<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        $users = User::where('company_id', auth()->user()->company_id)->with('company')->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $companies = CompanyModel::all();
        return view('dashboard.users.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin,manager',
        ]);

        $user =   User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => auth()->user()->company_id,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies = CompanyModel::all();
        return view('dashboard.users.edit', compact('user', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'company_id' => 'required|exists:company_models,id',
            'role' => 'required|in:user,admin,manager',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
