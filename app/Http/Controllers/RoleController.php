<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('role-index'), 403);

        $roles = Role::with('permissions')->get();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('role-create'), 403);

        // $permissions = Permission::all()->pluck('name', 'id');
        // dd($permissions);
        return Inertia::render('Roles/Create', [
            'permissions' => Permission::all()->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role create success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        abort_if(Gate::denies('role-show'), 403);

        $role->load('permissions');

        return Inertia::render('Roles/Show', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies('role-edit'), 403);

        $permissions = Permission::all()->pluck('name', 'id');

        $role->load('permissions');
        // dd($role);

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->only('name'));

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role-destroy'), 403);

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role delete success');
    }
}
