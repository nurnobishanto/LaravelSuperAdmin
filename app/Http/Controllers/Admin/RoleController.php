<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles =  Role::all();
        return view('admin.roles.index',compact('roles'));
    }
    public function create(){
        $permissions = Permission::all();
        $permissions_groups = Permission::select('group_name')->groupBy('group_name')->get();
        return view('admin.roles.create',compact(['permissions','permissions_groups']));
    }
    public function edit($id){

        $role =  Role::where('id',$id)->first();
        $permissions = Permission::all();
        $permissions_groups = Permission::select('group_name')->groupBy('group_name')->get();
        return view('admin.roles.edit',compact(['role','permissions','permissions_groups']));
    }
}
