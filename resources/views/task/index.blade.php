@extends('layouts.main')
@section('title', 'Task')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/task/task.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="category_control_buttons">
            <a href="{{url('task/create')}}">New Task</a>
        </div>
        <div class="table_div">

            @if (count($records))
                <div class="task_div">
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Creatot</th>
                            <th>Assign to</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Assign at</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        @foreach ($records as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->category_title }}</td>
                                <td>{{ $row->creator }}</td>
                                <td>{{ $row->assignee }}</td>
                                <td>{{ $row->start_date }}</td>
                                <td>{{ $row->end_date }}</td>
                                <td>{{ $row->assign_at }}</td>
                                <td>{{ $row->task_status }}</td>
                                <td>{{ $row->priority }}</td>
                                <td><a href="{{ url('task/edit?id=' . $row->id) }}">Edit</a></td>
                                <td><a href="{{ url('task/destroy?id=' . $row->id) }}">Delete</a></td>
                            </tr>
                        @endforeach
                   </table>
                </div>
            @else
                <h3>There's no tasks yet!</h3>
            @endif
        </div>
    </div>
@endsection
