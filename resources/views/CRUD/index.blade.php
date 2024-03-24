<!-- resources/views/users/index.blade.php -->
@extends('layouts.admin')

@section('content')

<section class="content">
<h1>Users</h1>

<a href="{{ route('users.create') }}">Create New User</a>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Nama Lengkap</th>
        <th>Alamat</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->nama_lengkap }}</td>
        <td>{{ $user->alamat }}</td>
        <td>{{ $user->role }}</td>
        <td>
            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</section>

@endsection
