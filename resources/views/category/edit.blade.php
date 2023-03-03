@extends('layouts.main')
@section('title', 'Edit Category')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/category/categorycreate.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="{{ url('category/update') }}" method="get">
            @csrf
            @if ($errors->any())
                <p>{{$errors->first()}}</p>
            @endif
            <label for="">Category Title</label>
            <input type="hidden" name="id" value="{{$record['id']}}">
            <input type="text" name="title" value="{{$record['title']}}">
            <input type="submit" value="Update">
        </form>
    </div>
@endsection
