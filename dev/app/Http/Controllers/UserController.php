<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'username', 'email', 'role')->orderBy('id')->get();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->save();

        return redirect()->route('admin.users.show', $user)->with('status', 'Gegevens opgeslagen.');
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Je kunt jezelf niet verwijderen.');

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
