<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand">Navbar</a>
        <form action="{{route('logout')}}" method="POST" role="search" class="d-flex">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
    </div>
</nav>
<h1>Welcome, {{Auth::user()->name}}</h1>


@if(Auth::user()->type == 'admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        You are a Admin User.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Links</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($links as $link)
            <tr>
                <th scope="row">{{ $link->id }}</th>
                <td>{{ $link->url }}</td>
                <td>{{ $link->title }}</td>
                <td>{{ $link->status }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif
@if(Auth::user()->type == 'manager')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        You are a Manager User.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Links</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($links as $link)
            <tr>
                <th scope="row">{{ $link->id }}</th>
                <td>{{ $link->url }}</td>
                <td>{{ $link->status }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif
</body>
</html>
