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

Route::get('/', function () {
    return view('welcome');
});




//Route::get('/dashboard','DashboardController@index');
Auth::routes();
Route::group(['middleware' =>'auth' ], function () {
    
    Route::get('/logout','AuthController@logout');

    Route::get('/dashboard','DashboardController@index')->name('dashboard.index');

    Route::name('project.')->group(function () {
        Route::get('/project', 'ProjectController@index')->name('index');
        Route::get('/project/role', 'ProjectController@memberRoleIndex')->name('role');
        Route::get('/data/project', 'ProjectController@projectTable')->name('projectData');
        Route::post('/project/active','ProjectController@activeProject')->name('active');
    
        //member
        Route::get('/project/{id}/member', 'ProjectMemberController@memberRoleIndex')->name('manageMember');
        Route::post('/project/{id}/member/store','ProjectMemberController@projectMemberStore')->name('member.store');
        Route::get('/data/projectMember/{id}','ProjectMemberController@projectMemberTable')->name('member.data');
    });

    Route::name('project.member.')->group(function(){
        Route::get('/project/config/member/{personId}','ProjectMemberController@updateRoleForm')->name('personal.data');
        Route::get('/project/config/member/add/{projectId}','ProjectMemberController@addMemberToProject')->name('selectMember');
        Route::post('/project/config/member/update/{projectId}','ProjectMemberController@updateRole')->name('role.update');
    });

    Route::name('project.info.')->group(function () {
        Route::get('/project/info', 'ProjectInfoController@index')->name('index');

    });
    
    Route::name('person.')->group(function () {
        Route::get('/pegawai', ' ProjectInfoController@index')->name('index');
    });
    
    
    Route::name('permintaan.')->group(function () {
        Route::get('/index/permintaan', 'PermintaanController@permintaanIndex')->name('index');
        Route::get('/index/permintaan/new', 'PermintaanController@permintaanBaruIndex')->name('index.baru');
        Route::get('/index/permintaan/disposisi', 'PermintaanController@permintaanDisposisi')->name('index.disposisi');
        Route::get('/data/permintaan', 'PermintaanController@permintaanTable')->name('permintaanData');
    });


    Route::name('works.')->group(function(){
        Route::get('/works/disposisi', 'WorksController@index')->name('index');
        Route::get('/works/disposisi_form/{permintaan_id}', 'WorksController@disposisiForm')->name('disposisiForm');
        Route::get('/works/workload', 'WorksController@workloadIndex');
        Route::get('/data/permintaan/disposisi/baru', 'WorksController@disposisiNewTable')->name('disposisiBaruData');
        Route::get('/data/workloadStaf','WorksController@stafWorkloadTable')->name('workLoad');
        Route::post('/disposisi/store','WorksController@sendDisposisi')->name('disposisiSend');
    });

    Route::name('box.')->group(function(){
        Route::get('/inbox/disposisi', 'DisposisiMessageController@inboxIndex')->name('inboxIndex');
        Route::get('/sent/disposisi', 'DisposisiMessageController@sentIndex')->name('sentIndex');
        Route::get('/data/inbox', 'DisposisiMessageController@inboxTable')->name('inboxData');
        Route::get('/data/sent', 'DisposisiMessageController@sentTable')->name('sentData');
    });

    Route::name('bagian.')->group(function(){
        Route::get('/bagian/list', 'BagianController@DaftarBagian')->name('index');
    });



    
    
    Route::get('/home', 'HomeController@index')->name('home');
     
});

Route::get('/sm/login', 'Auth\SubjectLoginController@showLoginForm')->name('sm.login');
Route::post('/sm/login', 'Auth\SubjectLoginController@login')->name('sm.login.post');
Route::get('/sm/logout', 'Auth\SubjectLoginController@logout')->name('sm.logout');


Route::group(['middleware'=>'subject_matter'], function() {
    Route::get('/sm/home', 'SubjectMatter\HomeController@index')->name('home.sm');
});
