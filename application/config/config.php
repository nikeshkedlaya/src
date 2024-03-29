<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * |--------------------------------------------------------------------------
 * | Base Site URL
 * |--------------------------------------------------------------------------
 * |
 * | URL to your CodeIgniter root. Typically this will be your base URL,
 * | WITH a trailing slash:
 * |
 * | http://example.com/
 * |
 * | If this is not set then CodeIgniter will guess the protocol, domain and
 * | path to your installation.
 * |
 */
$config['base_url'] = '';

/*
 * |--------------------------------------------------------------------------
 * | Index File
 * |--------------------------------------------------------------------------
 * |
 * | Typically this will be your index.php file, unless you've renamed it to
 * | something else. If you are using mod_rewrite to remove the page set this
 * | variable so that it is blank.
 * |
 */
$config['index_page'] = '';

/*
 * |--------------------------------------------------------------------------
 * | URI PROTOCOL
 * |--------------------------------------------------------------------------
 * |
 * | This item determines which server global should be used to retrieve the
 * | URI string. The default setting of 'AUTO' works for most servers.
 * | If your links do not seem to work, try one of the other delicious flavors:
 * |
 * | 'AUTO' Default - auto detects
 * | 'PATH_INFO' Uses the PATH_INFO
 * | 'QUERY_STRING' Uses the QUERY_STRING
 * | 'REQUEST_URI' Uses the REQUEST_URI
 * | 'ORIG_PATH_INFO' Uses the ORIG_PATH_INFO
 * |
 */
$config['uri_protocol'] = 'AUTO';

/*
 * |--------------------------------------------------------------------------
 * | URL suffix
 * |--------------------------------------------------------------------------
 * |
 * | This option allows you to add a suffix to all URLs generated by CodeIgniter.
 * | For more information please see the user guide:
 * |
 * | http://codeigniter.com/user_guide/general/urls.html
 */

$config['url_suffix'] = '';

/*
 * |--------------------------------------------------------------------------
 * | Default Language
 * |--------------------------------------------------------------------------
 * |
 * | This determines which set of language files should be used. Make sure
 * | there is an available translation if you intend to use something other
 * | than english.
 * |
 */
$config['language'] = 'english';

/*
 * |--------------------------------------------------------------------------
 * | Default Character Set
 * |--------------------------------------------------------------------------
 * |
 * | This determines which character set is used by default in various methods
 * | that require a character set to be provided.
 * |
 */
$config['charset'] = 'UTF-8';

/*
 * |--------------------------------------------------------------------------
 * | Enable/Disable System Hooks
 * |--------------------------------------------------------------------------
 * |
 * | If you would like to use the 'hooks' feature you must enable it by
 * | setting this variable to TRUE (boolean). See the user guide for details.
 * |
 */
$config['enable_hooks'] = FALSE;

/*
 * |--------------------------------------------------------------------------
 * | Class Extension Prefix
 * |--------------------------------------------------------------------------
 * |
 * | This item allows you to set the filename/classname prefix when extending
 * | native libraries. For more information please see the user guide:
 * |
 * | http://codeigniter.com/user_guide/general/core_classes.html
 * | http://codeigniter.com/user_guide/general/creating_libraries.html
 * |
 */
$config['subclass_prefix'] = 'KaHO_';

/*
 * |--------------------------------------------------------------------------
 * | Allowed URL Characters
 * |--------------------------------------------------------------------------
 * |
 * | This lets you specify with a regular expression which characters are permitted
 * | within your URLs. When someone tries to submit a URL with disallowed
 * | characters they will get a warning message.
 * |
 * | As a security measure you are STRONGLY encouraged to restrict URLs to
 * | as few characters as possible. By default only these are allowed: a-z 0-9~%.:_-
 * |
 * | Leave blank to allow all characters -- but only if you are insane.
 * |
 * | DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
 * |
 */
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

/*
 * |--------------------------------------------------------------------------
 * | Enable Query Strings
 * |--------------------------------------------------------------------------
 * |
 * | By default CodeIgniter uses search-engine friendly segment based URLs:
 * | example.com/who/what/where/
 * |
 * | By default CodeIgniter enables access to the $_GET array. If for some
 * | reason you would like to disable it, set 'allow_get_array' to FALSE.
 * |
 * | You can optionally enable standard query string based URLs:
 * | example.com?who=me&what=something&where=here
 * |
 * | Options are: TRUE or FALSE (boolean)
 * |
 * | The other items let you set the query string 'words' that will
 * | invoke your controllers and its functions:
 * | example.com/index.php?c=controller&m=function
 * |
 * | Please note that some of the helpers won't work as expected when
 * | this feature is enabled, since CodeIgniter is designed primarily to
 * | use segment based URLs.
 * |
 */
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd'; // experimental not currently in use

/*
 * |--------------------------------------------------------------------------
 * | Error Logging Threshold
 * |--------------------------------------------------------------------------
 * |
 * | If you have enabled error logging, you can set an error threshold to
 * | determine what gets logged. Threshold options are:
 * | You can enable error logging by setting a threshold over zero. The
 * | threshold determines what gets logged. Threshold options are:
 * |
 * | 0 = Disables logging, Error logging TURNED OFF
 * | 1 = Error Messages (including PHP errors)
 * | 2 = Debug Messages
 * | 3 = Informational Messages
 * | 4 = All Messages
 * |
 * | For a live site you'll usually only enable Errors (1) to be logged otherwise
 * | your log files will fill up very fast.
 * |
 */
$config['log_threshold'] = 1;

/*
 * |--------------------------------------------------------------------------
 * | Error Logging Directory Path
 * |--------------------------------------------------------------------------
 * |
 * | Leave this BLANK unless you would like to set something other than the default
 * | application/logs/ folder. Use a full server path with trailing slash.
 * |
 */
$config['log_path'] = '';

/*
 * |--------------------------------------------------------------------------
 * | Date Format for Logs
 * |--------------------------------------------------------------------------
 * |
 * | Each item that is logged has an associated date. You can use PHP date
 * | codes to set your own date formatting
 * |
 */
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['general_date_format'] = 'Y-m-d';

/*
 * |--------------------------------------------------------------------------
 * | Cache Directory Path
 * |--------------------------------------------------------------------------
 * |
 * | Leave this BLANK unless you would like to set something other than the default
 * | system/cache/ folder. Use a full server path with trailing slash.
 * |
 */
$config['cache_path'] = '';

/*
 * |--------------------------------------------------------------------------
 * | Encryption Key
 * |--------------------------------------------------------------------------
 * |
 * | If you use the Encryption class or the Session class you
 * | MUST set an encryption key. See the user guide for info.
 * |
 */
$config['encryption_key'] = '5b9cf718d8579f56ed68e613a00ef0a4';

/*
 * |--------------------------------------------------------------------------
 * | Session Variables
 * |--------------------------------------------------------------------------
 * |
 * | 'sess_cookie_name' = the name you want for the cookie
 * | 'sess_expiration' = the number of SECONDS you want the session to last.
 * | by default sessions last 7200 seconds (two hours). Set to zero for no expiration.
 * | 'sess_expire_on_close' = Whether to cause the session to expire automatically
 * | when the browser window is closed
 * | 'sess_encrypt_cookie' = Whether to encrypt the cookie
 * | 'sess_use_database' = Whether to save the session data to a database
 * | 'sess_table_name' = The name of the session database table
 * | 'sess_match_ip' = Whether to match the user's IP address when reading the session data
 * | 'sess_match_useragent' = Whether to match the User Agent when reading the session data
 * | 'sess_time_to_update' = how many seconds between CI refreshing Session Information
 * |
 */
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 43200;
$config['sess_expire_on_close'] = FALSE;
$config['sess_encrypt_cookie'] = FALSE;
$config['sess_use_database'] = FALSE;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_match_ip'] = FALSE;
$config['sess_match_useragent'] = TRUE;
$config['sess_time_to_update'] = 300;

/*
 * |--------------------------------------------------------------------------
 * | Cookie Related Variables
 * |--------------------------------------------------------------------------
 * |
 * | 'cookie_prefix' = Set a prefix if you need to avoid collisions
 * | 'cookie_domain' = Set to .your-domain.com for site-wide cookies
 * | 'cookie_path' = Typically will be a forward slash
 * | 'cookie_secure' = Cookies will only be set if a secure HTTPS connection exists.
 * |
 */
$config['cookie_prefix'] = "";
$config['cookie_domain'] = "";
$config['cookie_path'] = "/";
$config['cookie_secure'] = FALSE;

/*
 * |--------------------------------------------------------------------------
 * | Global XSS Filtering
 * |--------------------------------------------------------------------------
 * |
 * | Determines whether the XSS filter is always active when GET, POST or
 * | COOKIE data is encountered
 * |
 */
$config['global_xss_filtering'] = FALSE;

/*
 * |--------------------------------------------------------------------------
 * | Cross Site Request Forgery
 * |--------------------------------------------------------------------------
 * | Enables a CSRF cookie token to be set. When set to TRUE, token will be
 * | checked on a submitted form. If you are accepting user data, it is strongly
 * | recommended CSRF protection be enabled.
 * |
 * | 'csrf_token_name' = The token name
 * | 'csrf_cookie_name' = The cookie name
 * | 'csrf_expire' = The number in seconds the token should expire.
 */
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;

/*
 * |--------------------------------------------------------------------------
 * | Output Compression
 * |--------------------------------------------------------------------------
 * |
 * | Enables Gzip output compression for faster page loads. When enabled,
 * | the output class will test whether your server supports Gzip.
 * | Even if it does, however, not all browsers support compression
 * | so enable only if you are reasonably sure your visitors can handle it.
 * |
 * | VERY IMPORTANT: If you are getting a blank page when compression is enabled it
 * | means you are prematurely outputting something to your browser. It could
 * | even be a line of whitespace at the end of one of your scripts. For
 * | compression to work, nothing can be sent before the output buffer is called
 * | by the output class. Do not 'echo' any values with compression enabled.
 * |
 */
$config['compress_output'] = FALSE;

/*
 * |--------------------------------------------------------------------------
 * | Master Time Reference
 * |--------------------------------------------------------------------------
 * |
 * | Options are 'local' or 'gmt'. This pref tells the system whether to use
 * | your server's local time as the master 'now' reference, or convert it to
 * | GMT. See the 'date helper' page of the user guide for information
 * | regarding date handling.
 * |
 */
$config['time_reference'] = 'local';

/*
 * |--------------------------------------------------------------------------
 * | Rewrite PHP Short Tags
 * |--------------------------------------------------------------------------
 * |
 * | If your PHP installation does not have short tag support enabled CI
 * | can rewrite the tags on-the-fly, enabling you to utilize that syntax
 * | in your view files. Options are TRUE or FALSE (boolean)
 * |
 */
$config['rewrite_short_tags'] = FALSE;

// $config['root_directory'] = ''; // would be used different directory name for different client
// $config['db_configuration_path'] = $config['root_directory'] . '/application/config/database.php';
// $config['push_notification_configuration_path'] = $config['root_directory'] . '/application/config/push_notification_conf.php';
// $config['lessonplan_csv_filename'] = $config['root_directory'] ."_lessonplan"; /* change file name for every customer */
// $config['lessonplan_csv_filename']="actsss_lessonplan";
/*
 * |--------------------------------------------------------------------------
 * | Reverse Proxy IPs
 * |--------------------------------------------------------------------------
 * |
 * | If your server is behind a reverse proxy, you must whitelist the proxy IP
 * | addresses from which CodeIgniter should trust the HTTP_X_FORWARDED_FOR
 * | header in order to properly identify the visitor's IP address.
 * | Comma-delimited, e.g. '10.0.1.200,10.0.1.201'
 * |
 */
$config['proxy_ips'] = '';
$config['no_of_connection'] = 2;
//    $config['uploading_csv_path'] = "C:/Windows/Temp/"; // for uploading the master data 


//$config['uploading_csv_path'] = "/tmp/";

/* web admin upload path */
//$config['uploading_badge_path'] = "assets/upload/badges/";
//$config['download_template'] = "assets/upload/csvtemplate/";
//$config['upload_zip_path'] = "assets/upload/zip/";
//$config['upload_mcq_path'] = "mcq_pics/";
//
//$config['uploading_img_thumb'] = "assets/upload/thumb/"; //for 150*150
//$config['email_attachment_path'] = "mail"; //for 150*150
//$config['homework_attachment_path'] = "homework";
//$config['calendar_attachment_path'] = "calendar/";
//$config['task_attachment_path'] = "task/";
//$config['announcement_attachment_path'] = "announcement";
//$config['students_image_path'] = "student_pics"; //for 150*150
//$config['parents_image_path'] = "parent_pics"; //for 150*150
//$config['teachers_image_path'] = "teacher_pics"; //for 150*150
//$config['learning_resources_path'] = "learningresources"; //for 150*150
//$config['no_image_path'] = "noimage.png";
//
//$config['teachers_original_image_path'] = "teacher_pics/original_image/"; //for original image
//$config['teachers_thumb_150_path'] = "teacher_pics/teacher_thumb_150/"; //for 150*150
//$config['teachers_thumb_50_path'] = "teacher_pics/teacher_thumb_50/"; //for 50*50
//
//$config['students_original_image_path'] = "student_pics/original_image/"; //for original image
//$config['students_thumb_150_path'] = "student_pics/student_thumb_150/"; //for 150*150
//$config['students_thumb_50_path'] = "student_pics/student_thumb_50/"; //for 50*50
//
//$config['temp_table_prefix'] = "temp_";
//$config['memcache_log'] = true;
//$config['memory_image_upload'] = "assets/memory_media/memory_image/";
//$config['memory_video_upload'] = "assets/memory_media/memory_video/";
//$config['memory_audio_upload'] = "assets/memory_media/memory_audio/";





/* Admin upload csv file */

//$config['lessonplan_csv_path'] = "lessonplan/"; /*  */
//$config['mark_csv_path'] = "mark/"; /*  */
//$config['assessment_csv_path'] = "assessment/"; /*  */
//$config['assessmenttype_csv_path'] = "assessmenttype/"; /*  */
//$config['assessmentmode_csv_path'] = "assessmentmode/"; /*  */
//$config['subject_csv_path'] = "subject/";
//$config['teacher_csv_path'] = "teacher/";
//$config['book_csv_path'] = "book/";
//$config['sectionAY_csv_path'] = "sectionAY/";
//$config['student_csv_path'] = "student/";
//$config['mcq_csv_path'] = "mcq/";
//$config['timetable_csv_path'] = "timetable/";
//$config['engagement_csv_path'] = "engagement/";
//$config['calendar_csv_path'] = "calendar/";
//$config['announcement_csv_path'] = "announcement/";
//$config['activity_csv_path'] = "activity/";
//$config['concern_csv_path'] = "concern/";
//$config['observation_csv_path'] = "observation/";
//$config['compliment_csv_path'] = "compliment/";
//$config['upload_error_files_path'] = "uploaderrorfiles/";
///* Location: ./application/config/config.php */

