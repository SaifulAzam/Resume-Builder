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

    Route::get('/', 'ResumeController@showAllResumes')->name('all');
});

Route::name('users.')->prefix('profile')->group(function () {
    Route::get('/{username}/resumes', 'ResumeController@showAllResumes')->where(['username' => '[a-z0-9]+'])->name('resumes');
});

Route::get('/', function () {
    return view('pages.index');
})->name('index');