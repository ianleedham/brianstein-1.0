@extends('layouts.app')

@section('content')
    <h1>Admin page</h1>
    This is a copy of the admin page however the button to change user roles will simply reload the page and it only shows the current (guest) account
    <div class="table-responsive">
        <table class="table table-responsive table-striped table-hover">
            <thead>
            <th >Name</th>
            <th >E-Mail</th>
            <th >User</th>
            <th >Moderator</th>
            <th >Admin</th>
            <th ></th>
            </thead>
            <tbody>
            <tr>
                <form >
                    <td>{{ Auth::user()->name }}</td>
                    <td>{{ Auth::user()->email }} <input type="hidden" name="email" value="{{ Auth::user()->email }}"></td>
                    <td style="padding: 5px"><input type="checkbox" {{ Auth::user()->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                    <td style="padding: 5px"><input type="checkbox" {{ Auth::user()->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                    <td style="padding: 5px"><input type="checkbox" {{ Auth::user()->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                    <td><button type="submit" href="/admin/guest">Assign Roles</button></td>
                </form>
            </tr>
            </tbody>
        </table>
    </div>

@endsection