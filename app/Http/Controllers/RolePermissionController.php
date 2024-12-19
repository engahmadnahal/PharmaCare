<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RolePermissionController extends Controller
{


    // public function __construct()
    // {
    //     $this->authorizeResource(Role::class,'permissions/role');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'permission_id' => 'required|integer|exists:permissions,id',
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $permission = Permission::findOrFail($request->get('permission_id'));

            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }

            return response()->json(['message' => 'Permission updated successfully'],  Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!auth()->user()->can('Update-Role')){
            return abort(403,'unauthorized');
        }
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions;

        $permissions = Permission::where('guard_name', $role->guard_name)->get();
        foreach ($permissions as $permission) {
            $permission->setAttribute('granted', false);
            foreach ($rolePermissions as $rolePermission) {
                if ($rolePermission->id == $permission->id) {
                    $permission->setAttribute('granted', true);
                    break;
                }
            }
        }
        return response()->view('cms.spatie.roles.role-permissions', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
