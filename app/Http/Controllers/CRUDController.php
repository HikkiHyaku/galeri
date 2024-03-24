<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CRUDController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(5);
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required',

        ]);

        User::create($request->post());
        return redirect()->route('admin.users')->with('success','User has been created successfully.');
    }
    public function show(User $user)
    {

    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('admin.users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users');
    }
}

