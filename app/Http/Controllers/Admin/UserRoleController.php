<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LocationModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = LocationModel::with('department')->get();
        $roles = Role::all()->toArray();
        $users = User::with(['role', 'location.department'])->get()->toArray();
        /*     dd($users); */
        return view('Admin.Home.Components.Contents.UserRoles.UserRole', ['locations' => $locations, 'roles' => $roles, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rolename' => 'required|unique:roles,name',
            'description' => 'required'
        ]);

        $customMessages = [
            'rolename.required' => 'Không được để trống',
            'description.required' => 'Không được để trống',
            'rolename.unique' => 'Role đã tồn tại'
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {

            $error =  $validator->errors();

            $Erolename = $error->get('rolename');

            $Edescription = $error->get('description');

            return response()->json(['Erolename' => $Erolename, 'Edescription' => $Edescription]);
        }
        $role = Role::create(['name' => $request->input('rolename'), 'description' => $request->input('description')]);
        $permissionIds = [];
        if ($request->input('permission')) $permissionIds = $request->input('permission');
        foreach ($permissionIds as $item) {
            if ($item) {
                $permission = Permission::find($item);
                $role->givePermissionTo($permission);
            }
        }

        return response()->json($role);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locations = LocationModel::find($id);
        $locations->department;
        return response()->json($locations);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)

    {
        /* return response($request->input('permission')); */

        $validator = Validator::make($request->all(), [
            'rolename' => 'required',
            'description' => 'required'
        ]);

        $customMessages = [
            'rolename.required' => 'Không được để trống',
            'description.required' => 'Không được để trống',

        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {

            $error =  $validator->errors();

            return response()->json($error);
        }
        $permissionIds = [];
        Role::where('id', $request->input('id'))->update(['name' => $request->input('rolename'), 'description' => $request->input('description')]);

        if ($request->input('permission')) {
            $permissionIds = array_map('intval', $request->input('permission'));
        }
        $role = Role::find($request->input('id'));
        if ($role instanceof Role) {
            $permissions = Permission::find($permissionIds);

            if ($permissions) {
                $role->syncPermissions($permissions);
            }
        }

        return response()->json(204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id)->delete();
        return response()->json(204);
    }
}
