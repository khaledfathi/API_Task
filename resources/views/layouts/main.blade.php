<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @yield('links')
</head>
<body>
    <header>
        <h1>Task Management System</h1>
    </header>
    <nav>
        <ul class="left">
            <li><a class="active_home" href="{{url('')}}">Home</a></li>
            <li><a class="active_tasks" href="{{url('task')}}">Tasks</a></li>
            <li><a class="active_category" href="{{url('category')}}">Categories</a></li>
            <li><a class="active_users" href="{{url('user')}}">Users</a></li>
        </ul>
        <ul class='right'>
            <li><a href="">User Name | profile</a></li>
            <li><a href="">Logout</a></li>
        </ul>
    </nav>
    @yield('content')
    @yield('scripts')
</body>

</html>
