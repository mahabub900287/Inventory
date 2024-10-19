<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Services\Admin\RolePermission\RolePermissionService;
use App\DataTables\Admin\RolePermission\RolePermissionDataTable;
use App\Http\Requests\Admin\RolePermission\RolePermissionRequest;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    protected $rolePermissionService;

    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;

        $this->middleware('permission:All Roles|Create Role|Edit Role|Delete Role', ['only' => ['index', 'store']]);

        $this->middleware('permission:Create Role', ['only' => ['create', 'store']]);

        $this->middleware('permission:Edit Role', ['only' => ['edit', 'update']]);

        $this->middleware('permission:Delete Role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolePermissionDataTable $dataTable)
    {
        $page_title = 'Show Role Permission List';
        setbreadcumb("Show Role-Permission List", "Role-Permission");
        return $dataTable->render('admin.role_permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        setbreadcumb("Create Role", "Role-Permission");
        return view('admin.role_permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePermissionRequest $request)
    {
        $data = $request->validated();
        try {
            $this->rolePermissionService->storeOrUpdate($data);
            $notify[] = ['success', 'Role Create successfully'];

            return redirect()->route('admin.roles.index')->withNotify($notify);
        } catch (\Exception $e) {
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = $this->rolePermissionService->roleEdit($id);
            $role = $data['role'];
            $permissions = $data['permissions'];
            $rolePermissions = $data['rolePermissions'];
            setbreadcumb("Edit Role", "Role-Permission");
            return view('admin.role_permission.edit', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolePermissionRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->rolePermissionService->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Role Update successfully'];

            return redirect()->route('admin.roles.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->rolePermissionService->delete($id);
            $notify[] = ['success', 'Role delete successfully'];

            return redirect()->route('admin.roles.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
    public function bulk_action(Request $request)
    {
        try {
            $item = Role::whereIn('id', $request->ids)->get();
            if ($item->count() > 0) {
                Role::whereIn('id', $request->ids)->delete();
                return response()->json(['status' => 'ok']);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
