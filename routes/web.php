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
    dd($request->all()); // All the data being sent through the form
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