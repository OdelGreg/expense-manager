<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\User;

class UserManagementController extends Controller
{
    const Administrator = 1;

    public function roles()
    {
        return view('pages.roles', ['roles' => Roles::all()]);
    }

    public function addRole()
    {
        $fields = request()->validate([
            'name' => ['required', 'min:2'],
            'description' => ['required', 'min:3']
        ]);

        Roles::create($fields);
        
        session()->flash('notice', 'Role added.');

        return redirect()->route('roles');
    }

    public function updateRole()
    {
        $role = Roles::findOrFail(request('id'));

        if ($role->name == 'Administrator') 
        {
            session()->flash('notice', 'Administrator cannot be edited.');

            return redirect()->route('roles');
        }

        if (request('delete')) {
            $role->delete();

            return redirect()->route('roles');
        }

        $fields = request()->validate([
            'name' => ['required', 'min:2'],
            'description' => ['required', 'min:3']
        ]);

        $role->update($fields);

        session()->flash('notice', 'Role updated.');

        return redirect()->route('roles');
    }


    public function users()
    {
        return view('pages.users', ['users' => User::all(), 'roles' => Roles::all()]);
    }

    public function addUser()
    {
        $fields = request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'role_id' => ['required']
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'role_id' => request('role'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        session()->flash('notice', 'User added.');

        return redirect()->route('users');
    }

    public function updateUser()
    {
        $user = User::findOrFail(request('id'));

        if ($user->role_id == self::Administrator && (request('role') != self::Administrator || request('delete'))) 
        {
            session()->flash('notice', 'Administrator role cannot be edited.');

            return redirect()->route('users');
        }

        if (request('delete')) {
            $user->delete();

            return redirect()->route('users');
        }

        $fields = request()->validate([
            'name' => ['required', 'min:2']
        ]);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'role_id' => request('role')
        ]);

        session()->flash('notice', 'User updated.');

        return redirect()->route('users');
    }
}
