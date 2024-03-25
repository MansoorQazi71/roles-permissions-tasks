<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permission',['only'=>['index']]);
        $this->middleware('permission:create permission',['only'=>['create','store']]);
        $this->middleware('permission:update permission',['only'=>['edit','update']]);
        $this->middleware('permission:delete permission',['only'=>['destroy']]);
    }
   public function index(){
    $permissions = Permission::get();
return view('role-permission.permission.index',['permissions'=>$permissions]);
   }
   public function create(){
    return view('role-permission.permission.create');
   }
   public function store(Request $request)
   {
    $request->validate([
        'name'=>['required','string','unique:permissions,name']
    ]);
    Permission::create(['name' => $request->name]);
    return redirect('permissions')->with('status','permission created succcessfully');
   }
   public function edit(Permission $permission){
    return view('role-permission.permission.edit',['permission'=>$permission]);
   }
   public function update(Request $request, Permission $permission){
    $request->validate([
        'name'=>['required','string','unique:permissions,name,'.$permission->id]
    ]);
    $permission->update([
        'name'=>$request->name,

    ]);
    return redirect('permissions')->with('status','Permission updated successfully');
   }
   public function destroy($permissionId){
    $permission = Permission::find($permissionId);
    $permission->delete();
    return redirect('permissions')->with('status','Permission deleted successfully');
   }
}
