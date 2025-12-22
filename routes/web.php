<?php

use \App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/task', function ()  {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');


Route::patch('/tasks/{task}/toggle', function (Task $task) {
    $task->update([
        'completed' => ! $task->completed
    ]);

    return redirect()->route('tasks.show', $task);
})->name('tasks.toggle');



Route::patch('/tasks/{task}/toggle', function (Task $task) {
    $task->completed = ! $task->completed;
    $task->save();

    return back()->with(
        'success',
        $task->completed
            ? 'Task marked as completed successfully ✅'
            : 'Task marked as incomplete ❌'
    );
})->name('tasks.toggle');

Route::get('/task/{task}/edit', function (Task $task){
    return view('edit', [ 
    'task' => $task  

    ]);
})->name('tasks.edit');

Route::view('/task/create', 'create')
-> name('tasks.create');

Route::get('/task/{task}', function (Task $task)  {
    return view('show', [

        'task' => $task 
    ]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request){ 
    
    // $data = ;
    // $task = new Task;
    // $task->title= $data['title'];
    // $task->description= $data['description'];
    // $task->long_description= $data['long_description'];
    // $task -> save();
  
    $task = Task::create($request -> validated());

    return redirect()->route('tasks.show', ['task' =>  $task -> id] )
    ->with('success', value: 'Task Created Succesfully :)' );

})->name('tasks.store');


Route::put('/task/{task}', function(Task $task, TaskRequest $request){ 
    
    // $data = $request -> validated();
    // $data = ;
    // $task->title= $data['title'];
    // $task->description= $data['description'];
    // $task->long_description= $data['long_description'];
    // $task -> save();
    $task -> update($request -> validated());

    return redirect()->route('tasks.show', ['task' =>  $task -> id] )
    ->with('success', 'Task Updated Succesfully :)' );

})->name('tasks.update');




Route::delete('/task/{task}', function (Task $task) {

$task -> delete();

return redirect()-> route('tasks.index')
->with('success', 'Task deleted Successfully!');

})->name('tasks.destroy');
