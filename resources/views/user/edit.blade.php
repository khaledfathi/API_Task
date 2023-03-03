@extends('layouts.main')
@section('title', 'Edit User')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/user/usercreate.css') }}">
@endsection

@section('content')
    <div class="container">
        @csrf
        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif
        <form action="{{ url('user/update') }}" method="get">
            <label for="">User Name</label>
            <input type="text" name="name" value="{{$record->name}}">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Empty will not change the password">
            <label for="">Confirm Password</label>
            <input type="password" name="password_confirmation">
            <label for="">Email</label>
            <input type="text" name="email" value="{{$record->email}}" >
            <label for="">Phone</label>
            <input type="text" name="phone" value="{{$record->phone}}">
            <label for="">Type</label>
            <select name="type" id="">
                @foreach ($types as $key=>$value)
                    @if ($key == $record->type)
                        <option selected value="{{$key}}">{{$value}}</option>
                    @else
                        <option  value="{{$key}}">{{$value}}</option>
                    @endif
                @endforeach
            </select>
            <label for="">Status</label>
            <select name="status" id="">
                @foreach ($status as $key=>$value)
                    @if ($key == $record->status)
                        <option selected value="{{$key}}">{{$value}}</option>
                    @else
                        <option  value="{{$key}}">{{$value}}</option>
                    @endif
                @endforeach
            </select>
            <input type="hidden" , name="id" value="{{$record->id}}">
            <input type="submit" value="Update">
        </form>

    </div>
@endsection
