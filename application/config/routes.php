<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'welcome';
$route['admin'] = 'admin/login';
$route['dashboardAdmin.html'] = 'welcome/dashboardAdmin';
$route['dashboardEmployee.html'] = 'welcome/dashboardEmployee';
$route['profile.html/(:any)'] = 'welcome/profile/$1';
$route['changepassword.html'] = 'welcome/changepassword';
$route['department.html'] = 'welcome/department';
$route['designation.html'] = 'welcome/designation';
$route['addbranch.html'] = 'welcome/addbranch';
$route['brancheslist.html'] = 'welcome/brancheslist';
$route['organizationSettings.html'] = 'welcome/organizationSettings';
$route['forgotpassword.html'] = 'welcome/forgotpassword';
$route['employeelist.html'] = 'welcome/employeelist';
$route['employee-edit.html/(:any)'] = 'welcome/employeedit/$1';
$route['holidays.html'] = 'welcome/holidays';
$route['addleave.html'] = 'welcome/addleave';
$route['adminleave.html'] = 'welcome/adminleave';
$route['attendanceEmployee.html'] = 'welcome/attendanceEmployee';
$route['attendanceAdmin.html'] = 'welcome/attendanceAdmin';
$route['employeePayroll.html'] = 'welcome/employeePayroll';
$route['salarySlip.html/(:any)'] = 'welcome/salarySlip/$1';
$route['employeePayrolluser.html'] = 'welcome/employeePayrolluser';
$route['currentmonthsalarySlip.html/(:any)'] = 'welcome/currentmonthsalarySlip/$1';
$route['accountBank.html'] = 'account/accountBank';
$route['accountHead.html'] = 'account/accountHead';
$route['accountGroup.html'] = 'account/accountGroup';
$route['accountSubhead.html'] = 'account/accountSubhead';
$route['vendorCustomer.html'] = 'account/vendorCustomer';
$route['journalEntries.html'] = 'account/journalEntries';

$route['ledger.html'] = 'account/ledger';
$route['ledgerdetail.html'] = 'account/ledgerdetail';
$route['balancesheet.html'] = 'account/balancesheet';
$route['trialbalance.html'] = 'account/trialbalance';
$route['profitloss.html'] = 'account/profitloss1';
$route['cash.html'] = 'account/cash';
$route['contra.html'] = 'account/contra';
$route['calldetail.html'] = 'caller/calldetail';
$route['calldetail1.html'] = 'caller/calldetail1';
$route['counselor.html'] = 'caller/counselor';
$route['fullcalldetail.html'] = 'caller/fullcalldetail';
$route['tages.html'] = 'caller/tages';
$route['class.html'] = 'caller/class';
$route['boardanduniversity.html'] = 'caller/boardanduniversity';
$route['stream.html'] = 'caller/stream';
$route['admission.html'] = 'caller/admission';
$route['coordinator.html'] = 'caller/coordinator';
$route['receptionDashboard.html'] = 'caller/reception_dashboard';
$route['telecallerDashboard.html'] = 'caller/telecaller_dashboard';
$route['counselorDashboard.html'] = 'caller/counselor_dashboard';
$route['admissionDashboard.html'] = 'caller/admission_dashboard';
$route['followup.html'] = 'caller/followup';
$route['followupCounsler.html'] = 'caller/followupCounsler';
$route['newleadgerdetail.html/(:any)'] = 'account/newleadgerdetail/$1';
$route['profitlossdetail.html/(:any)/(:any)'] = 'account/profitlossdetail/$1/$2';
$route['employeePayrolledit.html/(:any)'] = 'welcome/employeePayrolledit/$1';
$route['headdetail.html/(:any)'] = 'account/headdetail/$1';
$route['balancesheetheadDetail.html/(:any)/(:any)'] = 'account/balancesheetheadDetail/$1/$2';
/*$route['category.html'] = 'welcome/category';
$route['about.html'] = 'welcome/about';
$route['services.html'] = 'welcome/services';
$route['team.html'] = 'welcome/team';
$route['gallery.html'] = 'welcome/gallery';
$route['page404.html'] = 'welcome/page404';
$route['infopedia/(:any)/(:any)/(:any).html']='infopedia/services/$1/$2/$3';
$route['InfopediaCategory.html'] = 'infopedia/category';
$route['infopedia/(:any)/(:any).html'] = 'infopedia/subcategory/$1/$2';

$route['(:any).html'] = 'welcome/subcategory/$1';
$route['category/(:any)/(:any).html'] = 'welcome/subcategory/$1/$2';
$route['(:any)/(:any)/(:any).html'] = 'welcome/product/$1/$2/$3';
*/
$route['404_override'] = 'welcome/error';
$route['translate_uri_dashes'] = FALSE;
