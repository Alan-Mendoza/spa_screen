<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::all()->pluck('name', 'id'),
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
        $user->syncRoles($roles);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user
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

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Auth::user()->id == $user->id){
            return redirect()->route('users.index');
        } else {
            $user->delete();
        }

        return redirect()->route('users.index');
    }
}
