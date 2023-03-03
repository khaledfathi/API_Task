@extends('layouts.main')
@section('title', 'Category')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/category/category.css') }}">
@endsection

@section('content')
    <div class="container">

        <div class="category_control_buttons">
            <a href="{{ url('category/create') }}">New Categroy</a>
        </div>
        <div class="category_div">
            @if (count($categories))
                <table>
                    <thead>
                        <th width=10%>ID</th>
                        <th>Category</th>
                        <th width=15%>Edit</th>
                        <th width=15%>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td><a href="{{ url('category/edit?id=' . $row->id) }}">Edit</a></td>
                                <td><a href="{{ url('category/destroy?id=' . $row->id) }}">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3>there's No Categories Yet !</h3>
            @endif
        </div>
    </div>
@endsection
