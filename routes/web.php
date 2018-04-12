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

Route::name('resumes.')->prefix('resumes')->group(function () {
    Route::get('/new', 'ResumeController@createResume')->name('create');
    Route::get('/{resume_id}', 'ResumeController@showResume')->where(['resume_id' => '[0-9]+'])->name('single');
    Route::get('/', 'ResumeController@showAllResumes')->name('all');
});

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/{user_id}/resumes', 'ResumeController@showAllResumes')->where(['user_id' => '[0-9]+'])->name('resumes');
});

Route::get('/', function () {
    return view('welcome');
});
