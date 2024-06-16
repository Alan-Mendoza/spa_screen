<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('permission-index'), 403);

        return Inertia::render('Permissions/Index', [
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('permission-create'), 403);

        return Inertia::render('Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        // Permission::create($request->only('name'));
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->guard_name = 'web';
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission create success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission-show'), 403);

        return Inertia::render('Permissions/Show', [
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission-edit'), 403);

        return Inertia::render('Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('success', 'Permission update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission-destroy'), 403);

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission delete success');
    }
}
