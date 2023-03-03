@extends('layouts.main')
@section('title', 'Edit Task')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/task/taskcreate.css') }}">
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif
        <form action="{{ url('task/update') }}" method="get">
            @csrf
            <label for="">Title</label>
            <input type="text" name="title" value="{{$record->title}}">
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10">{{$record->description}}</textarea>
            <label for="">Start Date</label>
            <input type="date" name="start_date" value="{{$record->start_date}}">
            <label for="">End Date</label>
            <input type="date" name="end_date" value="{{$record->end_date}}">
            <label for="">Assign at</label>
            <input type="date" name="assign_at" value="{{$record->assign_at}}">

            <label for="">Createor </label>
            <select name="creator_id" id="">
                @if ($record->assignee_id == null)
                    <option selected value="">------</option>
                @endif
                @foreach ($users as $user)
                    @if ($record->creator_id == $user->id)
                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach 
            </select>

            <label for="">Assign To </label>
            <select name="assignee_id" id="">
                @if ($record->assignee_id == null)
                    <option selected value="">------</option>
                @endif
                @foreach ($users as $user)
                    @if ($record->assignee_id == $user->id)
                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
            <label for="">Statut</label>
            <select name="status" id="">
                @foreach ($status as $item)
                    @if($record->task_status == $item->value)
                        <option selected value="{{ $item->name }}">{{ $item->value }}</option>
                    @else 
                        <option value="{{ $item->name }}">{{ $item->value }}</option>
                    @endif
                @endforeach
            </select>
            <label for="">Priority</label>
            <select name="priority" id="">
                 @foreach ($priority as $item)
                    @if($record->priority == $item->value)
                        <option selected value="{{ $item->name }}">{{ $item->value }}</option>
                    @else 
                        <option value="{{ $item->name }}">{{ $item->value }}</option>
                    @endif
                @endforeach
            </select>
            <label for="">Category</label>
            <select name="category_id" id="">
                @if ($record->category_id == null)
                    <option selected value="">------</option>
                @endif
                @foreach ($categories as $category)
                    @if ($record->category_id == $category->id)
                        <option selected value="{{ $category->id }}">{{ $category->title }}</option>
                    @else
                        <option  value="{{ $category->id }}">{{ $category->title }}</option>
                    @endif
                @endforeach 
            </select>
            <input type="hidden" name="id" value="{{$record->id}}">
            <input type="submit" value="Update">
        </form>

    </div>
@endsection
