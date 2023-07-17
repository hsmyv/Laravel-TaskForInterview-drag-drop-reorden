<?php

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

Route::get('/', function () {
    $users = User::orderby('position')->get();
    return view('welcome')->with(['users' => $users]);
});


Route::post('/', function (Request $request) {
    $positions = json_decode($request->positions, true);
    foreach ($positions as $position) {
        $user = User::find($position['id']);
         $user->position = $position['position'];
         $user->save();
    }
})->name('drag.drop');
