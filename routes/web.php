<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Students\LessonController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Teachers\CourseController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    return view('homepage');
})->name('home');

Route::get('/welcomeByLaravel', function () {
    return view('welcomeByLaravel');
})->name('welcomeByLaravel');

Route::get('/admin',[AdminController::class,'index'])->name('admin');
Route::get('/about',[AboutController::class,'about'])->name('about');

// For Student
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $users=User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');

    Route::get('/welcome', function () {
        $users=User::all();
        return view('student.welcome', compact('users'));
    })->name('first');

    Route::get('/student/login',[StudentController::class,'login'])->name('s.login');
    Route::get('/student/information',[StudentController::class,'myinfo'])->name('myinfo');
    Route::get('/student/register',[StudentController::class,'regis'])->name('regis');
    Route::get('/student/schedule',[StudentController::class,'schedule'])->name('schedule');
    Route::get('/student/grading',[StudentController::class,'grading'])->name('grading');
    Route::post('/student/information/add',[myinfoController::class,'store'])->name('adddatatoDB');
});

Route::group(['middleware' => 'auth'], function(){
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::resource('lessons', LessonController::class);
    });
    Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
        Route::resource('courses', CourseController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('users', UserController::class);
    });
});

Route::resource('tasks', TaskController::class);

Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
Route::post('/department/add',[DepartmentController::class,'store'])->name('addDepartment');

Route::post('/student/register/add',[StudentController::class,'storeRegistration'])->name('addRegistration');
Route::post('/student/register/delete/{ClassID}',[StudentController::class,'delete']);
Route::post('/student/register/update/',[StudentController::class,'updated'])->name('updatedRegistration');

Route::resource('student',StudentController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', TaskController::class);

    Route::resource('users', UsersController::class);
});

 //Service
 Route::get('/service/all',[StudentController::class,'index'])->name('services');
 Route::post('/service/add',[StudentController::class,'store'])->name('addService');

 Route::get('/service/edit/{id}',[StudentController::class,'edit']);
 Route::post('/service/update/{id}',[StudentController::class,'updated']);
 Route::get('/service/delete/{id}',[StudentController::class,'delete']);