<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:view_roles|add_roles|edit_roles|delete_roles', ['only' => ['index','show']]);
         $this->middleware('permission:add_roles', ['only' => ['create','store']]);
         $this->middleware('permission:edit_roles', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_roles', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $rolePermissions = [];

        foreach ($roles as $role) {
            $rolePermissions[] = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->get();
        }

        $permissions = Permission::get();
        return view('roles.index',compact('roles', 'permissions', 'rolePermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create($validatedData);
        $role->syncPermissions($request->permission);
    
        return redirect()->route('roles.index')
                        ->with('msg_success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
                            ->where("role_has_permissions.role_id",$id)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();
    
        return view('roles.update',compact('data','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        //? kenapa tidak pakai updaye karena yang kita ubah hanya nama rolenya saja, dan untuk coloum yang lain seperti guard_name kan tidak ada berarti jika tidak ada nanti ketika di update akan error 
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permission);
    
        return redirect()->route('roles.index')
                        ->with('msg_success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
    
    
}
