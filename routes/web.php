<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/courses', [App\Http\Controllers\CoursesController::class, 'index'])->name('courses');
Route::get('/courses/add', [App\Http\Controllers\CoursesController::class, 'create'])->name('add-course');
Route::post('/courses/save', [App\Http\Controllers\CoursesController::class, 'store'])->name('save-course');
Route::get('/courses/edit/{id}', [App\Http\Controllers\CoursesController::class, 'edit'])->name('edit-course');
Route::post('/courses/edit/save', [App\Http\Controllers\CoursesController::class, 'update'])->name('save-edit-course');
Route::get('/courses/delete/{id}', [App\Http\Controllers\CoursesController::class, 'destroy'])->name('destroy-course');
Route::get('/courses/xml', [App\Http\Controllers\CoursesController::class, 'viewXML'])->name('XML');
Route::post('/courses/import/xml', [App\Http\Controllers\CoursesController::class, 'importXML'])->name('import');

Route::get('/students', [App\Http\Controllers\StudentsController::class, 'index'])->name('student');
Route::get('/students-edit/{id}', [App\Http\Controllers\StudentsController::class, 'edit'])->name('edit-student');
Route::get('/students/add', [App\Http\Controllers\StudentsController::class, 'create'])->name('add-student');
Route::post('/students/save', [App\Http\Controllers\StudentsController::class, 'store'])->name('save-student');
Route::get('/students/edit/{id}', [App\Http\Controllers\StudentsController::class, 'edit'])->name('edit-student');
Route::post('/students/edit/save', [App\Http\Controllers\StudentsController::class, 'update'])->name('save-edit-student');
Route::get('/students/delete/{id}', [App\Http\Controllers\StudentsController::class, 'destroy'])->name('destroy-student');
Route::post('/students/classes', [App\Http\Controllers\StudentsController::class, 'listClasses'])->name('list-classes');

