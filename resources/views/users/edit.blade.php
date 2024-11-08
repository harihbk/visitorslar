@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Edit Role</h2>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Role Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="form-group">
            <label>Permissions:</label><br>
            @foreach($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}> {{ $permission->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
