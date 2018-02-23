<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Todo List App</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <h1 class="text-center">Todo List</h1>

<footer class="footer">
    <div class="container">
</footer>
<script src="{{asset('js/app.js')}}"></script>
{{-- tasks.store --}}
<form action="{{ route('tasks.store')}}" method="POST">
  {{ csrf_field() }}
  <div class="form-group row">
    <div class="col-md-9">
      <input type="text" name="newTaskName" class="form-control" placeholder="名前">
      <input type="text" name="newTaskComment" class="form-control" placeholder="コメント">
    </div>
    <div class="col-md-3">
      <input type="submit" class="btn btn-primary form-control" value="追加">
    </div>
  </div>
</form>

{{-- Table --}}
@if(count($tasks) > 0)
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">名前</th>
                <th scope="col">コメント</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                      <td>{{ $task->comment }}</td>
                <td>
                    <a href="{{ route('tasks.edit', ['tasks' => $task->id]) }}" class="btn btn-outline-secondary">編集</a>
                </td>
                <td>
                    <form action="{{ route('tasks.destroy', ['tasks' => $task->id]) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger" value="削除">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endif

   {{-- Pagination --}} <!-- 追加 -->
   {{ $tasks->links('vendor.pagination.simple-bootstrap-4') }} <!-- 追加 -->
</div>
</div>
</div>
<footer class="footer">
  {{-- Session flash --}}
@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success:</strong>
        {{ Session::get('success') }}
    </div>
@endif

{{-- Error Message --}}
@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error:</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- tasks.store --}}

</body>
</html>
