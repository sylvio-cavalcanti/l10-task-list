<?php

use Illuminate\Http\Response;
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

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description, // optional
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}

$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('tasks.index'); // 'index' --> route that shows a list of elements 

Route::get('/tasks/{id}', function ($id) use ($tasks) {
    // We only want one task, using an specific id being passed
    // to get an specific id from the array we would have to loop the array until we had found it
    // the laravel way of doind this is using the collect function
    // This function will convert arrays into laravel collection, which are objects in php
    // in php arrays are primitive data types, they are objects

    $task = collect($tasks)->firstWhere('id', $id);
    /* 
        firstWhere() is searching for the first occurrence where the property 'id' in the $tasks collection
        is the same as the variable $id from the route that is being passed as parameter
    */
    if(!$task) { 
        // If the data base model or page is not found, returns an 'Not Found' error
        // Must import 'Illuminate\Http\Response;'
        abort(Response::HTTP_NOT_FOUND);
    }
    // If the id is found in the other hand, the show.blade page will be shown 
    return view('show', ['task' => $task]);

})->name('tasks.show'); // 'show' --> route that shows a single element 



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