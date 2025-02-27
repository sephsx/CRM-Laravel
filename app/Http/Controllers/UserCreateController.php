<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Traits\HasRoles;

class UserCreateController extends Controller
{
    use HasRoles;
    // display all uusers to see in the user
    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request, User $user)
    {
        if (Auth::user()->hasRole('admin')) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
            User::create(request()->all());
            return redirect()->route('users.index')->with('success', 'User created successfully');
        }
    }


    public function edit(User $user)
    {
        return view('user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $user->update($request->only('first_name', 'last_name', 'email'));

        return redirect(route('users.index'))->with('success', 'User updated successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
