<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user',['only'=>['index']]);
        $this->middleware('permission:create user',['only'=>['create','store']]);
        $this->middleware('permission:update user',['only'=>['edit','update']]);
        $this->middleware('permission:delete user',['only'=>['destroy']]);
    }
    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', ['users' => $users]);
    }
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('role-permission.user.create', ['roles' => $roles]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required|array'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect('users')->with('status', 'User created successfully');
    }
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view(
            'role-permission.user.edit',
            [
                'user' => $user,
                'roles' => $roles,
                'userRoles' => $userRoles
            ]
        );
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required|array'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (!empty($request->password)) {
            $data +=[
                'password' => Hash::make($request->password),
            ];
        }
        $user->update($data);
        $user->syncRoles($request->roles);
        return redirect('users')->with('status','User updated successfully');
    }
    public function destroy($userId)
    {
$user = User::findOrFail($userId);
$user->delete();
return redirect('users')->with('status','user deleted successfully');
    }
}
