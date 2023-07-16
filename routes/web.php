<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;

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


Route::get('/', function(){
    return redirect()->route('task.index');
});
Route::post('/task/reorden', function (Request $request) {
    $positions = json_decode($request->positions, true);
    foreach ($positions as $position) {
        $task = Task::find($position['id']);
         $task->position = $position['position'];
         $task->save();
    }
})->name('drag.drop');


Route::resource('task', TaskController::class);
