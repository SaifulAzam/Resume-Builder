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

Route::name('resumes.')
    ->prefix('resumes')
    ->group(function () {
        Route::get('/new', 'ResumeController@showResumeForm')->name('create');
        Route::post('/new', 'ResumeController@storeResume')->name('store');

        Route::get('/{resume_id}', 'ResumeController@showResume')->name('single');
        Route::post('/{resume_id}/download', 'ResumeController@downloadResume')->name('download');
        Route::post('/{resume_id}/duplicate', 'ResumeController@duplicateResume')->name('duplicate');
        Route::put('/{resume_id}', 'ResumeController@updateResume')->name('update');
        Route::delete('/{resume_id}', 'ResumeController@deleteResume')->name('destroy');
});

Route::middleware('auth')
    ->name('dashboard.')
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/resumes', 'ResumeController@showAllResumes')->name('resumes.all');
        Route::get('/resumes/templates', 'DashboardController@showResumeTemplates')->name('resumes.templates');
        Route::get('/resumes/templates/upload', 'DashboardController@showUploadResumeTemplateForm')->name('resumes.templates-upload');
        Route::post('/resumes/templates/upload', 'DashboardController@uploadResumeTemplate');
        Route::delete('/resumes/templates', 'DashboardController@deleteResumeTemplate');
        Route::get('/users', 'DashboardController@showUsers')->name('users');
        Route::get('/{username}/resumes', 'ResumeController@showAllResumes')->name('resumes');
        Route::delete('/{username}', 'DashboardController@deleteUser')->name('profile.delete');
        Route::get('/{username}/profile', 'DashboardController@showProfile')->name('profile');
        Route::post('/{username}/profile', 'DashboardController@updateProfile');
        Route::get('/{username}', 'DashboardController@showStatistics')->name('statistics');
});

Route::get('/', function () {
    return view('pages.index');
})->name('index');