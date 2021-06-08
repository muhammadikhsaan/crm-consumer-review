<?php

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {   
        Route::get('/dashboard', 'DashboardController@showDashboard')
        ->name('dashboard');
        
        Route::get('/dashboard/program', 'DashboardController@showSummaryOne')
                ->name('dashboard.program');

        Route::get('/dashboard/progress', 'DashboardController@showSummaryTwo')
                ->name('dashboard.progress');

        Route::get('/profile', 'DashboardController@showProfile')
                ->name('user.profile');

        Route::put('/profile', 'DashboardController@updateUser');

        Route::group(['middleware' => ['privileges:admin']], function () {   
                Route::get('/journey/add', 'AdminController@showAddJouney')
                        ->name('dashboard.journey.add');

                Route::get('/journey/update', 'AdminController@updateJouney')
                        ->name('dashboard.journey.update');

                Route::put('/journey/update', 'AdminController@storeUpdateJouney');

                Route::get('/journey/delete/{id}', 'AdminController@deleteJouney')
                        ->name('dashboard.journey.delete');

                Route::get('/progress/add', 'AdminController@showAddProgress')
                        ->name('dashboard.progress.add');

                Route::post('/progress/add', 'AdminController@storeAddProgress');

                Route::get('/progress/update', 'AdminController@updateProgress')
                        ->name('dashboard.progress.update');

                Route::put('/progress/update', 'AdminController@storeUpdateProgress');

                Route::get('/progress/delete/{program}/{id}', 'AdminController@deleteProgress')
                        ->name('dashboard.progress.delete');

                Route::post('/journey/add', 'AdminController@storeAddJouney');

                Route::get('/program/add', 'AdminController@showAddProgram')
                        ->name('dashboard.program.add');

                Route::post('/program/add', 'AdminController@storeAddProgram');

                Route::get('/program/update', 'AdminController@updateProgram')
                        ->name('dashboard.program.update');

                Route::put('/program/update', 'AdminController@storeUpdateProgram');

                Route::put('/program/update/priority', 'AdminController@priorityUpdateProgram')
                        ->name('dashboard.program.update.priority');

                Route::get('/program/delete/{journey}/{id}', 'AdminController@deleteProgram')
                        ->name('dashboard.program.delete');

                Route::get('/users', 'UsersController@listUsers')
                        ->name('users');

                Route::delete('/users/delete/{id}', 'UsersController@deleteUsers')
                        ->name('users.delete');

                Route::get('/users/update/{id}', 'UsersController@updateUsers')
                        ->name('users.update');

                Route::put('/users/update/{id}', 'UsersController@handleUpdate');

        });

        Route::group(['middleware' => ['privileges:inputer']], function () {   
                Route::get('/task', 'InputerController@dataForinput')
                        ->name('dashboard.task');

                Route::get('/progress/update/progress', 'InputerController@inputProgress')
                        ->name('dashboard.progress.update.inputer');

                Route::put('/progress/update/progress', 'InputerController@storeInputProgress');

                Route::put('/progress/update/status/inputer', 'DashboardController@statusUpdateProgress')
                        ->name('dashboard.progress.update.status.inputer');
        });

        Route::group(['middleware' => ['privileges:verifikator']], function () {
                Route::put('/progress/update/status/verifikator', 'DashboardController@statusUpdateProgress')
                        ->name('dashboard.progress.update.status.verifikator');

                Route::get('/verifikasi', 'VerifikatorController@dataForchecked')
                        ->name('dashboard.verifikator');        
        });
});

