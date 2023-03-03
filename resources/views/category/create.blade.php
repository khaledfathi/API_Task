@extends('layouts.main')
@section('title', 'New Category')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/category/categorycreate.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="{{ url('category/store') }}" method="get">
            @csrf
            @if ($errors->any())
                <p class="error">{{$errors->first()}}</p>
            @endif
            <label for="">Category Title</label>
            <input type="text" name="title">
            <input type="submit" value="Create">
        </form>

    </div>
@endsection
