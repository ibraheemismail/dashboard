<?php




Auth::routes();

Route::match(['get', 'post'], '/','AdminController@login');
Route::get('/ho', 'MailController@home');
Route::post('/send/email','MailController@sendemail');

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']],function(){
	Route::get('/admin/dashboard','AdminController@dashboard');	
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

	// Categories Routes (Admin)
	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategories');
	Route::get('/search','CategoryController@searchCategory');
	
		// Product Routes (Admin)
		Route::match(['get','post'],'/admin/add-product','ProductController@addProduct');
		Route::match(['get','post'],'/admin/edit-product/{id}','ProductController@editProduct');
		Route::match(['get','post'],'/admin/delete-product/{id}','ProductController@deleteProduct');
		Route::get('/admin/view-product','ProductController@viewProduct');
	
	
});



/*Route::get('/', function () {
	return view('login');});*/
	
Route::get('/logout','AdminController@logout');