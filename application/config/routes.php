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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'clinic';
$route['registration'] = 'registration/index';
$route['registration/submit'] = 'registration/submit';
$route['calendar'] = 'calendar/index';
$route['calendar/get_appointments'] = 'calendar/get_appointments';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['schedule/view_schedule/(:any)/(:any)'] = 'schedule/view_schedule/$1/$2';
$route['schedule/add_appointment'] = 'schedule/add_appointment';
$route['schedule/update_appointment/(:num)'] = 'schedule/update_appointment/$1';
$route['schedule/delete_appointment/(:num)'] = 'schedule/delete_appointment/$1';
$route['medication'] = 'medication/index';
$route['medication/add'] = 'medication/add';
$route['medication/add/(:any)'] = 'medication/add/$1';
$route['medication/store'] = 'medication/store';
$route['medication/edit/(:any)'] = 'medication/edit/$1';
$route['medication/update/(:any)'] = 'medication/update/$1';
$route['medication/delete/(:any)'] = 'medication/delete/$1';
$route['medication/search'] = 'medication/search';
$route['medication/search_form'] = 'medication/search_form';
$route['auth/authenticate'] = 'auth/authenticate';
$route['reports/appointments'] = 'reports/appointments';
$route['reports/medical'] = 'reports/medical';
$route['reports/download_csv/(:any)'] = 'reports/download_csv/$1';
$route['reports/download_excel/(:any)'] = 'reports/download_excel/$1';
$route['reports/download_pdf/(:any)'] = 'reports/download_pdf/$1';
$route['onlineappointments/edit/(:num)'] = 'onlineappointments/online_edit/$1';
$route['onlineappointments/update/(:num)'] = 'onlineappointments/online_update/$1';

// // application/config/routes.php

// $route['default_controller'] = 'onlineappointments'; // Sets the default controller
// $route['onlineappointments'] = 'onlineappointments/index'; // Maps to the index method
// $route['onlineappointments/create'] = 'onlineappointments/create'; // Maps to create method
// $route['onlineappointments/edit/(:num)'] = 'onlineappointments/edit/$1'; // Maps to edit method
// $route['onlineappointments/update/(:num)'] = 'onlineappointments/update/$1'; // Maps to update method
// $route['onlineappointments/delete/(:num)'] = 'onlineappointments/delete/$1'; // Maps to delete method
// application/config/routes.php
$route['diagnosiscontroller/add/(:num)'] = 'DiagnosisController/add/$1';
$route['onlineappointments/approve/(:num)'] = 'onlineappointments/approve/$1';
$route['onlineappointments/reject/(:num)'] = 'onlineappointments/reject/$1';
$route['export/csv'] = 'ExportController/export_csv';
$route['export/excel'] = 'ExportController/export_excel';
$route['export/online_csv'] = 'ExportController/export_online_csv';
$route['export/online_excel'] = 'ExportController/export_online_excel';
$route['report_view'] = 'ExportController/report_view';
$route['report/(:any)'] = 'report/index/$1';
$route['reports/monthly'] = 'ReportController/monthly';
$route['reports/weekly'] = 'ReportController/weekly';
$route['appointments/finish/(:num)'] = 'appointments/finish/$1';
$route['checkup'] = 'checkup/index';
$route['checkup/create'] = 'checkup/create';
$route['checkup/store'] = 'checkup/store';
$route['checkup/update/(:num)'] = 'checkup/update/$1';
$route['checkup/update_action'] = 'checkup/update_action';
$route['checkup/delete/(:num)'] = 'checkup/delete/$1';
$route['medication/add/(:num)'] = 'medication/add/$1';
$route['findings/search_patient'] = 'findings/search_patient';
$route['findings/search'] = 'findings/search';
$route['findings/add_findings/(:any)'] = 'findings/add_findings/$1';
$route['findings'] = 'findings/index'; // Adjust according to your structure
$route['findings/store'] = 'findings/store';
$route['onlineappointments/online_update/(:num)'] = 'onlineappointments/online_update/$1';
$route['reports/export_to_csv/(:any)/(:any)'] = 'reports/export_to_csv/$1/$2';

