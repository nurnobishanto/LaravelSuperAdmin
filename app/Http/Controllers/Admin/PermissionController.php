<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index(){
        $permissions =  Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }
    public function create(){
        return view('admin.permissions.create');
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required|unique:permissions|min:3',
            'guard_name'=>'required|min:3',
        ]);
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);



        return redirect()->back()->withSuccess('Permission Created', $request->name. 'has been created!');
    }
}
