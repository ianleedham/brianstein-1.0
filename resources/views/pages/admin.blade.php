@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <th>Name</th>
            <th>E-Mail</th>
            <th>User</th>
            <th>Moderator</th>
            <th>Admin</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <form action="{{ route('admin.assign') }}" method="post">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                        <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                        <td><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                        <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                        {{ csrf_field() }}
                        <td><button type="submit">Assign Roles</button></td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection