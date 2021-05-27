<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::whereIn('type', [UserType::TEACHER, UserType::STUDENT])->paginate(20);

        return view('admin.users.index', ['users' => $users]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'is_verified' => ['required', 'min:0', 'max:1']
        ]);

        $user->update(['is_verified' => $request->get('is_verified')]);

        return back()->with(['toast-type' => 'success', 'message' => 'User updated!']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with(['toast-type' => 'success', 'message' => 'User deleted!']);
    }
}
