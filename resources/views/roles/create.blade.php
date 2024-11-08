@extends('adminlte::page')


@section('content')
<div class="container">
    <h2>Create Role</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Role Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Permissions:</label><br>
            @foreach($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"> {{ $permission->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
