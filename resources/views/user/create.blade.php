@extends('layouts.main')
@section('title', 'New User')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/user/usercreate.css') }}">
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif
        <form action="{{ url('user/store') }}" method="post">
            @csrf
            <label for="">User Name</label>
            <input type="text" name="name">
            <label for="">Password</label>
            <input type="password" name="password">
            <label for="">Confirm Password</label>
            <input type="password" name="password_confirmation">
            <label for="">Email</label>
            <input type="text" name="email">
            <label for="">Phone</label>
            <input type="text" name="phone">
            <label for="">Type</label>
            <select name="type" id="">
                @foreach ($types as $item)                
                    <option selected value="{{$item->value}}">{{$item->name}}</option>
                @endforeach
            </select>
            <label for="">Status</label>
            <select name="status" id="">
                <option selected value="active">Active</option>
                <option value="not_active">Not Active</option>
            </select>

            <input type="submit" value="Create">
        </form>

    </div>
@endsection
