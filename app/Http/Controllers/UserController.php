<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('user-index'), 403);
        $users = User::with(['roles', 'permissions'])->get();

        return Inertia::render('Users/Index', [
            // 'users' => User::all(),
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('user-create'), 403);

        return Inertia::render('Users/Create', [
            'roles' => Role::all()->pluck('name', 'id'),
            'permissions' => Permission::all()->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $user = User::create($request->only('name', 'username', 'email') + [
            'password' => bcrypt($request->input('password'))
        ]);

        $roles = $request->input('roles', []);
        $permissions = $request->input('permissions', []);
        $user->syncRoles($roles);
        $user->syncPermissions($permissions);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort_if(Gate::denies('user-show'), 403);

        $user->load('roles');
        $user->load('permissions');

        return Inertia::render('Users/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user-edit'), 403);

        $roles = Role::all()->pluck('name', 'id');
        $permissions = Permission::all()->pluck('name', 'id');

        $user->load('roles');
        $user->load('permissions');

        // Obtener IDs de los roles del usuario
        $userRoleIds = $user->roles->pluck('id')->toArray();
        $userPermissionIds = $user->permissions->pluck('id')->toArray();

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoleIds' => $userRoleIds,
            'permissions' => $permissions,
            'userPermissionIds' => $userPermissionIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->only('name', 'username', 'email');
        $password = $request->input('password');

        if($password) {
            $data['password'] = bcrypt($password);
        }
        // if(trim($request->password) == '') {
        //     $data = $request->except('password');
        // } else {
        //     $data = $request->all();
        //     $data['password'] = bcrypt($request->input('password'));
        // }

        $user->update($data);

        $roles = $request->input('roles', []);
        $permissions = $request->input('permissions', []);

        $user->syncRoles($roles);
        $user->syncPermissions($permissions);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user-destroy'), 403);

        if(Auth::user()->id == $user->id){
            return redirect()->route('users.index');
        }
        $user->delete();

        return redirect()->route('users.index');
    }
}
