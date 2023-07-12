<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark">

<div class="container-fluid">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-light" href="/">Tasks</a>
    </li>
  </ul>
</div>

</nav>
    <div class="container">
        <div class="row py-2"></div>
        <div class="col-md-6">
            <a href="tasks/create" class='btn btn-dark mt-2'>New Task</a>
        </div>

        <!-- <div class="col-md-6">
            <div class="form-group">
                <form action="/tasks/search" method='get'>
                    <div class="input-group">
                        <input type="text" class='form-control' name='search' placeholder='Search...' value="{{ isset($search) ? $search : '' }}">
                        <button type='submit' class='btn btn-primary'> Search</button>
                    </div>
                </form>
            </div>
        </div> -->

        {{--<!-- @if($search !== 'null')
        {{collect($tasks)->where('title','like',"%$search%") }}
        @endif --> --}}

        <table class='table table-hover mt-2'>
            <thead>
                <tr>
                    <th>@sortablelink('id')</th>
                    <th>@sortablelink('title')</th>
                    <th>@sortablelink('description')</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <!-- <td>{{ $loop->index + 1}}</td> -->
                    <td>{{ $task->id}}</td>
                    <td><a href="/tasks/{{$task->id}}/show" class='text-dark'>{{ $task->title}}</a></td>
                    <td>{{ $task->description}}</td>
                    <td><a href="/tasks/{{$task->id}}/edit" class='btn btn-dark btn-sm'>Edit</a>
                    <form method='POST' action="/tasks/{{$task->id}}/delete" class='d-inline'>
                        @csrf
                        @method('DELETE')
                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>

        </table>
       {{-- <!-- {{dd($search)}} -->--}}
       {!! $tasks->appends(Request::except('page'))->render() !!}
      
    </div>
</body>
</html>