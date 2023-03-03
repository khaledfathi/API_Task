@extends('layouts.main')
@section('title', 'New Task')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/task/taskcreate.css') }}">
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif
        <form action="{{ url('task/store') }}" method="get">
            @csrf
            <label for="">Title</label>
            <input type="text" name="title">
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
            <label for="">Start Date</label>
            <input type="date" name="start_date">
            <label for="">End Date</label>
            <input type="date" name="end_date">
            <label for="">Assign at</label>
            <input type="date" name="assign_at">

            <label for="">Createor </label>
            <select name="creator_id" id="">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>

            <label for="">Assign To </label>
            <select name="assignee_id" id="">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <label for="">Statut</label>
            <select name="status" id="">
                @foreach ($status as $item)
                    <option value="{{$item->name}}">{{$item->value}}</option>
                @endforeach
            </select>
            <label for="">Priority</label>
            <select name="priority" id="">
                @foreach ($priority as $item)
                    <option value="{{$item->name}}">{{$item->value}}</option>
                @endforeach
            </select>
            <label for="">Category</label>
            <select name="category_id" id="">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            <input type="submit" value="Create">
        </form>

    </div>
@endsection
