<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
use Session;
class TaskController extends Controller
{
  public function index()
{
$tasks = Task::orderBy('id','desc')->paginate(5); # id番号逆順で表示する。

return view('tasks.index', compact('tasks')); #Views/tasks/index.blade.phpを表示
}
public function store(Request $request)
{
    $this->validate($request, [
        'newTaskName' => 'required|max:255',
        'newTaskComment' => 'required|max:255',
    ]); # 5文字未満、255文字以上は入力制限
    $task = new Task;
    $task->name = $request->newTaskName; # name="newTaskName"
    $task->comment =$request->newTaskComment;
    $task->save();

        Session::flash('success', 'New has been succesfully added!');
    return redirect()->route('tasks.index');
}

public function edit($id)
{
    $task = Task::findOrFail($id);
    return view('tasks.edit', compact('task'));
}

public function update(Request $request, $id)
{
    $this->validate($request, [
        'updatedTaskName' => 'required|max:255',
        'updatedTaskComment' => 'required|max:255',
    ]);
    $task = Task::findOrFail($id);
    $task->name = $request->updatedTaskName; # name="updatedTaskName"
      $task->comment = $request->updatedTaskComment; 
    $task->save();
 Session::flash('success', 'Task #' . $id . ' has been successfully update.');
    return redirect()->route('tasks.index');
}

public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

        Session::flash('success', 'Task #' . $id . ' has been successfully deleted.');
    return redirect()->route('tasks.index');
}
}
