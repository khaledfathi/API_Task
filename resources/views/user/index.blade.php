@extends('layouts.main')
@section('title', 'Task')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/user/user.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="category_control_buttons">
            <a href="http://localhost/user/create">New User</a>
        </div>
        @if (count($records))
            <div class="user_div">
                <table>
                    <thead>
                        <th width=5%>ID</th>
                        <th width=10%>Name</th>
                        <th width=20%>Email</th>
                        <th width=10%>Phone</th>
                        <th width=10%>Type</th>
                        <th width=10%>Status</th>
                        <th width=10%>Edit</th>
                        <th width=10%>Delete</th>
                    </thead>
                    @foreach ($records as $row)
                        <tbody>
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->type }}</td>
                                <td>{{ $row->status }}</td>
                                <td><a href="{{ url('user/edit?id=' . $row->id) }}">Edit</a></td>
                                <td><a href="{{ url('user/destroy?id=' . $row->id) }}">Delete</a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>

            </div>
        @else 
            <h3>There's no users yet!</h3>
        @endif
    </div>
@endsection
