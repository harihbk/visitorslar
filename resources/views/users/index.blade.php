@extends('adminlte::page')



@section('content')
<div class="container">
    <h2>User Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Roles</th>
                <th>Assign Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                    <td>
                        <form action="{{ route('users.assignRole', $user) }}" method="POST">
                            @csrf
                            <select name="roles[]" multiple class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Assign</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
