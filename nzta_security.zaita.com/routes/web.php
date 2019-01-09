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
URL::forceRootUrl('https://nzta-security.zaita.com');
Route::get('/', function () { return view('welcome'); });

Route::get('/proof-of-concept', 'ProofOfConceptController@index');
Route::post('/proof-of-concept/start', 'ProofOfConceptController@start');
Route::get('/proof-of-concept/questions', 'ProofOfConceptController@questions');
Route::get('/proof-of-concept/load-questions', 'ProofOfConceptController@load_questions');
Route::post('/proof-of-concept/save-answers', 'ProofOfConceptController@save_answers');
Route::get('/proof-of-concept/save-answers', 'ProofOfConceptController@save_answers');
Route::get('/proof-of-concept/update-answers', 'ProofOfConceptController@update_answers');
Route::get('/proof-of-concept/review-answers', 'ProofOfConceptController@review_answers');
Route::get('/proof-of-concept/submit-for-approval', 'ProofOfConceptController@submit_for_approval');
Route::get('/proof-of-concept/download-pdf', 'ProofOfConceptController@download_pdf');
Route::get('/proof-of-concept/ciso-approval', 'ProofOfConceptController@ciso_approval');
Route::get('/proof-of-concept/business-owner-approval', 'ProofOfConceptController@business_owner_approval');
Route::get('/proof-of-concept/summary', 'ProofOfConceptController@summary');
Route::get('/proof-of-concept/test', 'ProofOfConceptController@test');

Route::get('/software-as-a-service', 'SoftwareAsAServiceController@index');
Route::post('/software-as-a-service/start', 'SoftwareAsAServiceController@start');
Route::get('/software-as-a-service/questions', 'SoftwareAsAServiceController@questions');
Route::get('/software-as-a-service/load-questions', 'SoftwareAsAServiceController@load_questions');
Route::post('/software-as-a-service/save-answers', 'SoftwareAsAServiceController@save_answers');
Route::get('/software-as-a-service/save-answers', 'SoftwareAsAServiceController@save_answers');
Route::get('/software-as-a-service/update-answers', 'SoftwareAsAServiceController@update_answers');
Route::get('/software-as-a-service/review-answers', 'SoftwareAsAServiceController@review_answers');
Route::get('/software-as-a-service/submit-for-approval', 'SoftwareAsAServiceController@submit_for_approval');
Route::get('/software-as-a-service/download-pdf', 'SoftwareAsAServiceController@download_pdf');
Route::get('/software-as-a-service/ciso-approval', 'SoftwareAsAServiceController@ciso_approval');
Route::get('/software-as-a-service/business-owner-approval', 'SoftwareAsAServiceController@business_owner_approval');
Route::get('/software-as-a-service/summary', 'SoftwareAsAServiceController@summary');

Route::get('/solution', 'SolutionController@index');
Route::post('/solution/start', 'SolutionController@start');
Route::get('/solution/questions', 'SolutionController@questions');
Route::get('/solution/load-questions', 'SolutionController@load_questions');
Route::post('/solution/save-answers', 'SolutionController@save_answers');
Route::get('/solution/save-answers', 'SolutionController@save_answers');
Route::get('/solution/update-answers', 'SolutionController@update_answers');
Route::get('/solution/review-answers', 'SolutionController@review_answers');
Route::get('/solution/submit-for-approval', 'SolutionController@submit_for_approval');
Route::get('/solution/download-pdf', 'SolutionController@download_pdf');
Route::get('/solution/ciso-approval', 'SolutionController@ciso_approval');
Route::get('/solution/business-owner-approval', 'SolutionController@business_owner_approval');
Route::get('/solution/summary', 'SolutionController@summary');

Route::get('/feature-bug-fix', 'FeatureController@index');
Route::post('/feature-bug-fix/start', 'FeatureController@start');
Route::get('/feature-bug-fix/questions', 'FeatureController@questions');
Route::get('/feature-bug-fix/load-questions', 'FeatureController@load_questions');
Route::post('/feature-bug-fix/save-answers', 'FeatureController@save_answers');
Route::get('/feature-bug-fix/save-answers', 'FeatureController@save_answers');
Route::get('/feature-bug-fix/update-answers', 'FeatureController@update_answers');
Route::get('/feature-bug-fix/review-answers', 'FeatureController@review_answers');
Route::get('/feature-bug-fix/submit-for-approval', 'FeatureController@submit_for_approval');
Route::get('/feature-bug-fix/download-pdf', 'FeatureController@download_pdf');
Route::get('/feature-bug-fix/ciso-approval', 'FeatureController@ciso_approval');
Route::get('/feature-bug-fix/business-owner-approval', 'FeatureController@business_owner_approval');
Route::get('/feature-bug-fix/summary', 'FeatureController@summary');
