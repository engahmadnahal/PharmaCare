<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class EmployeeRoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->where('guard_name', 'employee')->where('guard_id', auth()->user()->id)->get();
        return response()->view('cms.spatie.roles.index', ['roles' => $roles, 'guard_name' => 'employee']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.spatie.roles.create', ['guard_name' => 'employee']);
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
            'name' => 'required|string|min:3|max:40',
        ]);

        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request->input('name');
            $role->guard_name = 'employee';
            $role->guard_id = auth()->user()->id;
            $isSaved = $role->save();
            return response()->json(['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        if ($role->guard_id != auth()->user()->id) {
            return abort(403, 'Unauthorized');
        }
        return response()->view('cms.spatie.roles.edit', ['role' => $role, 'guard_name' => 'employee']);
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
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:40',
        ]);

        if (!$validator->fails()) {
            $role = Role::findOrFail($id);
            if ($role->guard_id != auth()->user()->id) {
                return abort(403, 'Unauthorized');
            }
            $role->name = $request->get('name');
            $isSaved = $role->save();
            return response()->json(['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->guard_id != auth()->user()->id) {
            return abort(403, 'Unauthorized');
        }
        $isDeleted = $role->delete();
        return response()->json(['message' => 'Deleted successfully'], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
