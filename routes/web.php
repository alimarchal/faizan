<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\DB;

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
    return view('auth.login');
});

Route::get('/mail', function () {
    Mail::to("alirazamarchal@hotmail.com")->send(new \App\Mail\WelcomeMail());
    return new \App\Mail\WelcomeMail();
});


Auth::routes(['verify' => true]);
/*Route::group(['middleware' => ['auth', 'user']], function (){
    
});*/
Route::auth();
// Routes for Admin Panel
Route::group(['middleware' => ['auth', 'admin']], function () {
    
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::get('/reporting/HD', 'Admin\ReportConroller@index')->name('reporting.index');
     Route::get('/reporting/HEAJK', 'Admin\ReportConroller@HEAJK')->name('reporting.HEAJK');
    Route::get('/home', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/markAsRead', 'Admin\DashboardController@markAsRead')->name('markRead');
    
    Route::get('/employees', 'Admin\DashboardController@allUsers');
    Route::get('/employees/{id}/edit', 'Admin\DashboardController@edit');
    Route::put('/employees/{id}', 'Admin\DashboardController@update');
    Route::get('/employees/{id}/verify', 'Admin\DashboardController@VerifyUser');
    
    Route::get('/employee_profile/{id}', 'Admin\DashboardController@ViewEmployee');
    Route::resource('departments', 'Admin\DepartmentController');
    #####################################################
    Route::get('/employement-details/{id}/edit', 'Admin\EmployementDetailsController@index');
    Route::post('/employement-details/{id}', 'Admin\EmployementDetailsController@store');
    Route::get('/employement-details/{emp_id}/{employementDetails}', 'Admin\EmployementDetailsController@show');
    Route::put('/employement-details/{emp_id}/{employementDetails}', 'Admin\EmployementDetailsController@update');
    #####################################################
    
    Route::get('/qualifications/{id}/edit', 'Admin\QualificationController@index');
    Route::post('/qualifications/{id}', 'Admin\QualificationController@store');
    Route::get('/qualifications/{emp_id}/{qualification}', 'Admin\QualificationController@show');
    Route::put('/qualifications/{emp_id}/{qualification}', 'Admin\QualificationController@update');
    #####################################################
    
    Route::get('/professional_qualifications/{id}/edit', 'Admin\ProfessionalQualificationController@index');
    Route::post('/professional_qualifications/{id}', 'Admin\ProfessionalQualificationController@store');
    Route::get('/professional_qualifications/{emp_id}/{professionalQualification}', 'Admin\ProfessionalQualificationController@show');
    Route::put('/professional_qualifications/{emp_id}/{professionalQualification}', 'Admin\ProfessionalQualificationController@update');
    
    #####################################################
    Route::get('/trainings/{id}/edit', 'Admin\TrainingsController@index');
    Route::post('/trainings/{id}', 'Admin\TrainingsController@store');
    Route::get('/trainings/{emp_id}/{trainings}', 'Admin\TrainingsController@show');
    Route::put('/trainings/{emp_id}/{trainings}', 'Admin\TrainingsController@update');
    #####################################################
    
    ##################################################### (Best Example For Resource)
    Route::get('/teaching_details/{id}/create', 'Admin\TeachingDetailController@create');
    Route::get('/teaching_details/{id}', 'Admin\TeachingDetailController@index');
    Route::get('/teaching_details/{teachingDetail}/edit', 'Admin\TeachingDetailController@edit');
    Route::put('/teaching_details/{teachingDetail}', 'Admin\TeachingDetailController@update');
    Route::post('/teaching_details/{teachingDetail}', 'Admin\TeachingDetailController@store');
    #####################################################
    
    #####################################################
    Route::get('/result_history/{id}/create', 'Admin\ResultHistoryController@create');
    Route::get('/result_history/{id}', 'Admin\ResultHistoryController@index');
    Route::post('/result_history/{id}', 'Admin\ResultHistoryController@store');
    Route::get('/result_history/{resultHistory}/edit', 'Admin\ResultHistoryController@edit');
    Route::put('/result_history/{resultHistory}', 'Admin\ResultHistoryController@update');
    #####################################################
    
    #####################################################
    Route::get('/promotion_history/{id}', 'Admin\PromotionHistoryController@index');
    Route::post('/promotion_history/{id}', 'Admin\PromotionHistoryController@store');
    Route::get('/promotion_history/{id}/create', 'Admin\PromotionHistoryController@create');
    Route::get('/promotion_history/{promotion_history}/edit', 'Admin\PromotionHistoryController@edit');
    Route::put('/promotion_history/{promotion_history}', 'Admin\PromotionHistoryController@update');
    #####################################################
    
    
    #####################################################
    Route::get('/transfer_history/{id}', 'Admin\TransferHistoryController@index');
    Route::post('/transfer_history/{id}', 'Admin\TransferHistoryController@store');
    Route::get('/transfer_history/{id}/create', 'Admin\TransferHistoryController@create');
    Route::get('/transfer_history/{transfer_history}/edit', 'Admin\TransferHistoryController@edit');
    Route::put('/transfer_history/{transfer_history}', 'Admin\TransferHistoryController@update');
    #####################################################
    
    #####################################################
    //verification
    Route::get('/employee_verify/{id}', 'Admin\EmployementDetailsController@verify');
    Route::get('/qualifications/{id}', 'Admin\QualificationController@verify');
    Route::get('/professional_qualifications/{id}', 'Admin\ProfessionalQualificationController@verify');
    Route::get('/trainings/{id}', 'Admin\TrainingsController@verify');
    // Route::get('/teaching_details/{id}', 'Admin\TeachingDetailController@verify');
    // Route::get('/result_history/{id}', 'Admin\ResultHistoryController@verify');
    // Route::get('/promotion_history/{id}', 'Admin\PromotionHistoryController@verify');
    // Route::get('/transfer_history/{id}', 'Admin\TransferHistoryController@verify');
    
    #####################################################
    //    Route::get('/report/departmentFocalPerson', 'Admin\DashboardController@departmentFocalPerson');
    #####################################################
    
    
    #####################################################
    Route::get('/register/admin', 'Admin\DashboardController@registerAdmin');
    Route::post('/register/admin', 'Admin\DashboardController@registerAdminSubmit')->name('registerAdmin');
    #####################################################

    
    

});

Auth::routes(
    [
        'register' => 'Admin\DashboardController@index',
        ]
    );
    
    
    