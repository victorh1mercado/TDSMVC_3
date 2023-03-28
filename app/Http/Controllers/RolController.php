<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Iluminate\Support\Facades\BD;

class RolController extends Controller
{
    function __Construct()
    {
        $this->middleware('permission:ver-rol | crear-rol | editar-rol | borrar-rol',['only'=>['index']]);
        $this->middleware('permission:crear-rol',['only'=>['create','store']]);
        $this->middleware('permission:editar-rol',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-rol',['only'=>['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =Role::all();
        return view('roles.index,',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission=Permission::get();
        return view('roles.crear')
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','permission' =>'required']);
        $role= Role::create(['name'=>$request->input('permision')]);
        $role->sycPermissions($request->input('permisssion'));
        return redirect()->ruote('roles.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission=Permission::get();
        $rolePermission=DB::table('role_has_permisssions')->where('role_has_permissions.role_id',$id);
        //metodo pluck, recupera todos los valores de clave dterminada $id
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.editar', compact('role','permision','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->->validate($request,['name'=>'required','permission' =>'required']);
        $role= Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->ruote('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
