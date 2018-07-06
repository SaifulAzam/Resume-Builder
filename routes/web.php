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

Route::name('resumes.')->prefix('resumes')->group(function () {
    Route::get('/new', 'ResumeController@showResumeForm')->name('create');
    Route::post('/new', 'ResumeController@storeResume')->name('store');

    Route::get('/{resume_id}', 'ResumeController@showResume')->name('single');
    Route::put('/{resume_id}', 'ResumeController@updateResume')->name('update');
    Route::delete('/{resume_id}', 'ResumeController@deleteResume')->name('destroy');
});

Route::middleware('auth')
    ->name('dashboard.')
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/resumes', 'ResumeController@showAllResumes')->name('resumes.all');
        Route::get('/users', 'DashboardController@showUsers')->name('users');
        Route::get('/{username}/resumes', 'ResumeController@showAllResumes')->name('resumes');
        Route::get('/{username}/profile', 'DashboardController@showProfile')->name('profile');
        Route::post('/{username}/profile', 'DashboardController@updateProfile');
        Route::get('/{username}', 'DashboardController@showStatistics')->name('statistics');
});

Route::get('/', function () {
    return view('pages.index');
})->name('index');