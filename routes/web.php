<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

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
    //return view('welcome');
    return redirect('home');
});



Route::get('/home', [QuizController::class, 'getCategories']);

Route::get('/{category}', [QuizController::class, 'showQuiz']);
    
Route::post('/{category}', [QuizController::class, 'processUserAnswers']);


 