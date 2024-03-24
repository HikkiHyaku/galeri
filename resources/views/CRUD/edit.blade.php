<!-- resources/views/users/edit.blade.php -->
<h1>Edit User</h1>
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="username" value="{{ $user->username }}">
    <input type="email" name="email" value="{{ $user->email }}">
    <input type="password" name="password" value="{{ $user->password }}">
    <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}">
    <input type="text" name="alamat" value="{{ $user->alamat }}">
    <select name="role">
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>Petugas</option>
        <option value="peminjam" {{ $user->role === 'peminjam' ? 'selected' : '' }}>Peminjam</option>
    </select>
    <button type="submit">Update</button>
</form>
