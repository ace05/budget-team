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

Route::get('/', 'CandidateController@index')->name('home');
Route::post('/filter/team', 'CandidateController@filterTeam');
Route::get('/candidates', 'CandidateController@getCandidates')->name('candidate.list');
Route::get('/candidates/add', 'CandidateController@addCandidate')->name('candidate.add');
Route::post('/candidates/add', 'CandidateController@createCandidate');

Route::get('/candidates/edit/{id}', 'CandidateController@editCandidate')->name('candidate.edit');
Route::post('/candidates/edit/{id}', 'CandidateController@updateCandidate');

Route::get('/candidates/delete/{id}', 'CandidateController@deleteCandidate')->name('candidate.delete');