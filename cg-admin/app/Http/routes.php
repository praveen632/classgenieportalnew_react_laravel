<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

    return Redirect::to('login');
});

/*** Routes For Login Modules */
Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'LoginController@checkLogin');
Route::resource('/home', 'HomeController');
  
/***  Routes Start For Change Password */
Route::get('/change_password', function(){
  return view('change_password.change_password');
});

Route::post('change_password', 'ChangePasswordController@changePassword');
/***  Routes End For Change Password */

Route::get('/logout', 'LoginController@checkLogout');

/*********  Routes Start For Clanguage ********/
Route::get('/language', function() {
	return view('language');
});
Route::post('language', 'LanguageController@updatelanguage');

Route::post('lang_ajax', 'LanguageController@languagechange');

//***********ROUTING FOR CONTENT MANAGEMENET******************//
Route::post('contentlist/save','contentController@saveEditor');
Route::get('contentlist',function(){

return view('contentManagement.contentListing');	
});
Route::get('contentlist/{id}','contentController@getData');
Route::get('deleteContent/{id}','contentController@deleteContent');
Route::get('searchcontent/{where}','contentController@getSearchData');

//***********ROUTING FOR CONTENT MANAGEMENET******************//


Route::get('superuser',function(){
return view('super');
});

/***  Routes For Staff Management Modules */
Route::resource('rolemanagement','RolemangController');

/***  Routes For Admin User Management Modules */
Route::resource('usermanagement','UsermangController');


/***  Routes Start For Testing Ajax */
Route::get('/testing', function(){
  return view('testing.testing');
});
Route::get('testing/{id}','TestingController@getData');
Route::post('testing', 'TestingController@testAjax');
//****Routes For Email Content Section******/
Route::get('emailcontent',function(){return view('emailmanagement.email');}) ;
Route::post('emailcontent/save','EmailContentController@saveData');
Route::get('emaillist', function(){return view('emailmanagement.emaillist');});	
Route::get('emailcontent/{id}','EmailContentController@editData');
Route::resource('searchemailcontent/list','EmailContentController@showData');	
Route::post('emaillist/export','EmailContentController@export');	

//Route::get('databyid/{where}','EmailContentController@databyid');

/***  Routes End For Testing Ajax */

/***  Routes For ClassimageController Modules */
Route::resource('imagemanagement/class','ClassimageController');

/***  Routes For StudentimageController Modules */
Route::resource('imagemanagement/student','StudentimageController');

/***  Routes For StudentimageskillController Modules */
Route::resource('imagemanagement/skill','StudentskillController');

/***  Routes For CustomizeSkill Modules */
Route::resource('imagemanagement/customizeskill','CustomizeskillController');

/***  Routes For Schools Modules */
Route::get('schools/list', ['uses' => 'SchoolsController@schools_list', 'as' => 'schools']);
Route::resource('schools','SchoolsController');
Route::get('update_school/{school_id}', ['uses' => 'SchoolsController@update_school', 'as' => 'update_school']);
Route::get('delete_school/{school_id}', ['uses' => 'SchoolsController@destroy', 'as' => 'delete_school']);
Route::get('sendmail_school/{email}', ['uses' => 'SchoolsController@sendmail', 'as' => 'sendmail_school']);
Route::get('views_school/{school_id}', ['uses' => 'SchoolsController@views', 'as' => 'views_school']);
Route::get('get_email/{id}', ['uses' => 'SchoolsController@get_email', 'as' => 'get_email']);

/*** Routes For Teacherstatus Modules ***/

Route::get('teacherstatus', ['uses' => 'TeacherstatusController@show', 'as' => 'teacherstatus']);
Route::get('teacherstatus/list', ['uses' => 'TeacherstatusController@listdata', 'as' => 'teacherstatus']);
Route::post('deactivate_teacher_status/{member_no}','TeacherstatusController@deactivate_teacher_status');

/*** Routes For Blog Modules ***/
Route::resource('bloglist','BlogController');
Route::get('blogs_list','BlogController@blogs_list');
Route::resource('blog/create','BlogController@create');
Route::resource('blog/save','BlogController@saveblog');
Route::get('delete_blog/{blog_id}', ['uses' => 'BlogController@destroy', 'as' => 'delete_blog']);

/*** Routes For TeacherList Modules ***/
Route::get('teacherlist', ['uses' => 'TeacherlistController@show', 'as' => 'teacherlist']);
Route::get('teacherlist/list', ['uses' => 'TeacherlistController@listdata', 'as' => 'teacherlist']);
Route::get('update_status/{id}', ['uses' => 'TeacherlistController@update_status', 'as' => 'update_status']);
Route::get('delete_status/{id}', ['uses' => 'TeacherlistController@update_status', 'as' => 'delete_status']);
Route::get('delete_teacher_status/{id}', ['uses' => 'TeacherlistController@delete_teacher_status', 'as' => 'delete_teacher_status']);
Route::get('update_teacher_status/{id}', ['uses' => 'TeacherlistController@update_teacher_status', 'as' => 'update_teacher_status']);
Route::resource('sendmail/{email}','TeacherlistController@sendmail');
Route::get('sendmaildelete/{email}', ['uses' => 'TeacherlistController@sendmaildelete', 'as' => 'sendmaildelete']);


