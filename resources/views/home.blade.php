<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TMS</title>
    <style>
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px
        }

        table {
            border-collapse: collapse;
            display: block;
        }

        .table_block {

            width: 1200px;
            height: 200px;
            overflow: scroll scroll;
        }
    </style>
</head>

<body>
    <h1>Task Managment System </h1>
    <hr>
    <a href="https://github.com/khaledfathi/API_Task" target="_blank">Source Code</a><br><br>
    <a href="{{ asset('assets/doc/requirements.pdf') }}" target="_blank">Requirements PDF</a><br><br>
    <a href="{{ url('diagrams') }}">Database Diagrams</a><br><br>
    <a download href="{{ asset('assets/postman/collection.json') }}">Download Postman API collections</a><br>
    <hr><br>
    <h3>View Database Tables</h3>
    <label for="">Users</label>
    <div class="table_block">
        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>password</th>
                <th>phone</th>
                <th>type</th>
                <th>status</th>
            </thead>
            @foreach ($tables['users'] as $row)
                <tbody>
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->password }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->status }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>

    </div><br>
    <hr><br>

    <label for="">categories</label>
    <div class="table_block">
        <table>
            <thead>
                <th>id</th>
                <th>title</th>
            </thead>
            @foreach ($tables['categories'] as $row)
                <tbody>
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->title }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div><br>
    <hr><br>

      <label for="">Tasks</label>
    <div class="table_block">
        <table>
            <thead>
                <th>id</th>
                <th>createor_id</th>
                <th>assignee_id</th>
                <th>category_id</th>
                <th>title</th>
                <th>desctiption</th>
                <th>start_date</th>
                <th>end_date</th>
                <th>assigne_at</th>
                <th>status</th>
                <th>priority</th>
            </thead>
            @foreach ($tables['tasks'] as $row)
                <tbody>
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->creator_id }}</td>
                        <td>{{ $row->assignee_id }}</td>
                        <td>{{ $row->category_id }}</td>
                        <td>{{ $row->title}}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->start_date }}</td>
                        <td>{{ $row->end_date }}</td>
                        <td>{{ $row->assign_at }}</td>
                        <td>{{ $row->status }}</td>
                        <td>{{ $row->priority }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</body>

</html>
