<?php

use App\Http\Controllers\ProfileController;
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

Route::group(['middleware'=>'role:admin|manager'],function()
{

    Route::resource('permissions',App\Http\Controllers\permissionController::class);
    Route::resource('roles',App\Http\Controllers\RoleController::class);
    Route::get('permissions/{permissonId}/delete',[App\Http\Controllers\permissionController::class,'destroy']);
    Route::get('roles/{roleId}/delete',[App\Http\Controllers\RoleController::class,'destroy']);
    Route::get('roles/{roleId}/give-permissions',[App\Http\Controllers\RoleController::class,'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions',[App\Http\Controllers\RoleController::class,'givePermissionToRole']);
    
    Route::resource('users',App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete',[App\Http\Controllers\UserController::class,'destroy']);

});

// Middleware
// For admin and manager roles
Route::middleware('role:admin|manager')->resource('tasks', App\Http\Controllers\TaskController::class);

// For regular users
Route::middleware('check.role')->resource('tasks', App\Http\Controllers\TaskController::class)->only(['index', 'show']);

Route::get('/my-tasks', [App\Http\Controllers\TaskController::class, 'myTasks'])->name('my-tasks');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'role:admin'])->name('admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Route::group(['middleware' => 'role:admin|manager|user'], function () {
//     // Task routes
//     Route::resource('tasks', App\Http\Controllers\TaskController::class)->except(['create', 'edit']);
//     Route::get('tasks/{task}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->middleware('can:update,task');
//     Route::delete('tasks/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->middleware('can:delete,task');

//     // User management routes
//     Route::group(['middleware' => 'role:admin'], function () {
//         Route::resource('users', App\Http\Controllers\UserController::class)->except(['create', 'edit']);
//         Route::get('users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->middleware('can:update,user');
//         Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('can:delete,user');

//         Route::resource('permissions', App\Http\Controllers\PermissionController::class)->except(['create', 'edit']);
//         Route::get('permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit']);
//         Route::delete('permissions/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy']);

//         Route::resource('roles', App\Http\Controllers\RoleController::class)->except(['create', 'edit']);
//         Route::get('roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit']);
//         Route::delete('roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy']);
//     });
// });
