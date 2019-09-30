<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * | -------------------------------------------------------------------------
 * | URI ROUTING
 * | -------------------------------------------------------------------------
 * | This file lets you re-map URI requests to specific controller functions.
 * |
 * | Typically there is a one-to-one relationship between a URL string
 * | and its corresponding controller class/method. The segments in a
 * | URL normally follow this pattern:
 * |
 * | example.com/class/method/id/
 * |
 * | In some instances, however, you may want to remap this relationship
 * | so that a different class/function is called than the one
 * | corresponding to the URL.
 * |
 * | Please see the user guide for complete details:
 * |
 * | http://codeigniter.com/user_guide/general/routing.html
 * |
 * | -------------------------------------------------------------------------
 * | RESERVED ROUTES
 * | -------------------------------------------------------------------------
 * |
 * | There area two reserved routes:
 * |
 * | $route['default_controller'] = 'welcome';
 * |
 * | This route indicates which controller class should be loaded if the
 * | URI contains no data. In the above example, the "welcome" class
 * | would be loaded.
 * |
 * | $route['404_override'] = 'errors/page_missing';
 * |
 * | This route will tell the Router what URI segments to use if those provided
 * | in the URL cannot be matched to a valid route.
 * |
 */

// $route['default_controller'] = "static_page/pageview";
// $route['news'] = "news";
// $route['(:any)'] = "pages/view/$1";
$route['default_controller'] = 'login';
$route['404_override'] = 'errors/page_missing';

$route['kahoschool'] = 'kahoschool';
$route['kahoschool/AddSchool'] = 'kahoschool/AddSchool';

$route['user'] = "user/user";
$route['user/createaccount'] = "user/user/createaccount";
$route['userview/index'] = "user/user/index";
$route['user/index'] = "user/user/index";
$route['user/getLoggedin'] = "user/user/getLoggedin";
$route['user/loadDashboard'] = "user/user/loadDashboard";
$route['user/getSignupData'] = "user/user/getSignupData";
$route['user/getValidateForm'] = "user/user/getValidateForm";
$route['user/getAllUserList'] = "user/user/getAllUserList";
$route['user/createStudent'] = "user/user/createStudent";
$route['student/getList'] = "student/student/getList";
$route['student/InsertRecord'] = "student/student/InsertRecord";
$route['student'] = "student/student/index";
$route['student/GetMultipleRecord'] = "student/student/GetMultipleRecord";
$route['student/GetUserRecord'] = "student/student/GetUserRecord";
$route['student/GetUserProfile'] = "student/student/GetUserProfile";
$route['student/getSyllabus'] = "student/student/getSyllabus";
$route['student/ObjectColumnNameList'] = "student/student/ObjectColumnNameList";
$route['student/GetObjectRecord'] = "student/student/GetObjectRecord";
$route['student/GetPagination'] = "student/student/GetPagination";
$route['student/ObjectColumnNameList/(:any)'] = "student/student/ObjectColumnNameList/$1";
$route['student/GetObjectRecord/(:any)'] = "student/student/GetObjectRecord/$1";
$route['student/GetLoggedInWithGmail'] = "student/student/GetLoggedInWithGmail";
$route['student/GetLoggedOut/(:any)'] = "student/student/GetLoggedOut/$1";
$route['student/requestGmailList'] = "student/student/requestGmailList";
$route['student/getGmailContactList'] = "student/student/getGmailContactList";
$route['student/GetCalendar'] = "student/student/GetCalendar";
$route['student/DeleteEvent'] = "student/student/DeleteEvent";
$route['student/RegistrationEmail'] = "student/student/RegistrationEmail";
$route['student/getJsondata'] = "student/student/getJsondata";
$route['student/submitjson'] = "student/student/SubmitJson";
$route['subject'] = "subject/Index";

/* board */

$route['board'] = 'board/index';
$route['board/GetBoardList'] = 'board/GetBoardList';
$route['board/UpdateBoard'] = 'board/UpdateBoard';
$route['board/AddBoard'] = 'board/AddBoard';
$route['board/DeleteBoard'] = 'board/DeleteBoard';

/* Section */
$route['section'] = 'section/index';
$route['section/GetSectionList'] = 'section/GetSectionList';
$route['section/GetSectionListByPage'] = 'section/GetSectionListByPage';
$route['section/AddSection'] = 'section/AddSection';
$route['section/UpdateSection'] = 'section/UpdateSection';
$route['section/DeleteSection'] = 'section/DeleteSection';
$route['section/SearchSection'] = 'section/SearchSection';
$route['section/GetUploadedFile'] = 'section/GetUploadedFile';

/* class */
$route['classdetail'] = 'classdetail/index';
$route['classdetail/GetClassList'] = 'classdetail/GetClassList';
$route['classdetail/AddClass'] = 'classdetail/AddClass';
$route['classdetail/UpdateClass'] = 'classdetail/UpdateClass';
$route['classdetail/DeleteClass'] = 'classdetail/DeleteClass';

/* City */

$route['city'] = "city/Index";
$route['city/AddCity'] = "city/AddCity";
$route['city/GetCityList'] = "city/GetCityList";
$route['city/UpdateCity'] = "city/UpdateCity";
$route['city/DeleteCity'] = "city/DeleteCity";

/* CityArea */

$route['cityarea'] = "cityarea/index";
$route['cityarea/AddCityArea'] = "cityarea/AddCityArea";
$route['cityarea/GetCityAreaList'] = "cityarea/GetCityAreaList";
$route['cityarea/UpdateCityArea'] = "cityarea/UpdateCityArea";
$route['cityarea/DeleteCityArea'] = "cityarea/DeleteCityArea";

/* Chapter */

$route['chapter'] = "chapter/index";
$route['chapter/AddChapter'] = "chapter/AddChapter";
$route['chapter/GetChapterList'] = "chapter/GetChapterList";
$route['chapter/UpdateChapter'] = "chapter/UpdateChapter";
$route['chapter/DeleteChapter'] = "chapter/DeleteChapter";

/* login */
$route["login"] = "login/index";
$route["login/ResetPasswordForm"] = "login/ResetPasswordForm";
$route["login/ForgotPasswordForm"] = "login/ForgotPasswordForm";

/* End of file routes.php */
/* Location: ./application/config/routes.php */