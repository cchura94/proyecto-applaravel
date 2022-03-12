<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        $roles = Role::all();
        return view("admin.seguridad.index", compact("permisos", "roles"));
    }

    public function crearPermiso(Request $request)
    {
        $request->validate([
            "name" => "required|unique:permissions"
        ]);

        Permission::create(['name' => $request->name]);
        
        return redirect()->back()->with("mensaje", "Permiso Creado");
    }

    public function crearRol(Request $request)
    {
        
        $request->validate([
            "name" => "required|unique:permissions"
        ]);

        $role = new Role;
        $role->name=$request->name;
        $role->save();

        if($request->permisos){
            // agregar permisos a el rol
            foreach ($request->permisos as $permiso) {
                $role->givePermissionTo($permiso);
            }                
        }


        return redirect()->back()->with("mensaje", "Rol Creado");
        
    }

    public function modificarRolPermisos(Request $request, $id)
    {
        
        $role = Role::find($id);

        $role->syncPermissions($request->permisos);
        return redirect()->back()->with("mensaje", "Permisos Actualizados");
    }
}
