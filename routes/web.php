<?php

use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        // where() --> the completed column has to be true
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index'); // 'index' --> route that shows a list of elements 

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{id}', function ($id) {
    
    // Retriving a record from the Task table using the id primary key as reference
    // Note that id is coming from the route parameter
    return view('show', ['task' => \App\Models\Task::findOrFail($id)]);

})->name('tasks.show'); // 'show' --> route that shows a single element 

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        // Defining the name of the input fields and its validation rules
        'title' => 'required|max:255', // More then one rule can be set separated by a '|'
        'description' => 'required',
        'long_description' => 'required'
    ]);

    // Creating a new 'task' model
    $task = new Task;
    
    // Setting each value, one by one
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    // This creates a new class, which is a model that exists only in the memory and not the database

    // Saving to the databse using the save() method
    $task->save(); // Laravel will run an insert query, to save this record to the Task table in the DB 
    
    // Redirecting to the tasks.show page with the newly created record/task
    return redirect()->route('tasks.show', ['id' => $task->id]); // using an associative array

})->name('tasks.store');



// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

Route::fallback(function () {
    return 'Still got somewhere!';
});