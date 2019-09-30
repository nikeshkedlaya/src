<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * | -------------------------------------------------------------------
 * | DATABASE CONNECTIVITY SETTINGS
 * | -------------------------------------------------------------------
 * | This file will contain the settings needed to access your database.
 * |
 * | For complete instructions please consult the 'Database Connection'
 * | page of the User Guide.
 * |
 * | -------------------------------------------------------------------
 * | EXPLANATION OF VARIABLES
 * | -------------------------------------------------------------------
 * |
 * | ['hostname'] The hostname of your database server.
 * | ['username'] The username used to connect to the database
 * | ['password'] The password used to connect to the database
 * | ['database'] The name of the database you want to connect to
 * | ['dbdriver'] The database type. ie: mysql. Currently supported:
 * mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
 * | ['dbprefix'] You can add an optional prefix, which will be added
 * | to the table name when using the Active Record class
 * | ['pconnect'] TRUE/FALSE - Whether to use a persistent connection
 * | ['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
 * | ['cache_on'] TRUE/FALSE - Enables/disables query caching
 * | ['cachedir'] The path to the folder where cache files should be stored
 * | ['char_set'] The character set used in communicating with the database
 * | ['dbcollat'] The character collation used in communicating with the database
 * | NOTE: For MySQL and MySQLi databases, this setting is only used
 * | as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
 * | (and in table creation queries made with DB Forge).
 * | There is an incompatibility in PHP with mysql_real_escape_string() which
 * | can make your site vulnerable to SQL injection if you are using a
 * | multi-byte character set and are running versions lower than these.
 * | Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
 * | ['swap_pre'] A default table prefix that should be swapped with the dbprefix
 * | ['autoinit'] Whether or not to automatically initialize the database.
 * | ['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
 * | - good for ensuring strict SQL while developing
 * |
 * | The $active_group variable lets you choose which connection group to
 * | make active. By default there is only one group (the 'default' group).
 * |
 * | The $active_record variables lets you determine whether or not to load
 * | the active record class
 */

$active_group = 'default';
$active_record = FALSE;
$PDO_conn = TRUE;
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = "KaHO_MS";
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
$db['default']['dbrwconfig'] = 'W';

$db['kaho_ms']['hostname'] = 'localhost';
$db['kaho_ms']['username'] = 'root';
$db['kaho_ms']['password'] = '';
$db['kaho_ms']['database'] = "KaHO_MS";
$db['kaho_ms']['dbdriver'] = 'mysql';
$db['kaho_ms']['dbprefix'] = '';
$db['kaho_ms']['pconnect'] = FALSE;
$db['kaho_ms']['db_debug'] = TRUE;
$db['kaho_ms']['cache_on'] = FALSE;
$db['kaho_ms']['cachedir'] = '';
$db['kaho_ms']['char_set'] = 'utf8';
$db['kaho_ms']['dbcollat'] = 'utf8_general_ci';
$db['kaho_ms']['swap_pre'] = '';
$db['kaho_ms']['autoinit'] = TRUE;
$db['kaho_ms']['stricton'] = FALSE;
$db['kaho_ms']['dbrwconfig'] = 'W';

//$db['shravasti_report_db']['hostname'] = 'localhost';
//$db['shravasti_report_db']['username'] = 'root';
//$db['shravasti_report_db']['password'] = '';
//$db['shravasti_report_db']['database'] = "Shravasti_Report_DB";
//$db['shravasti_report_db']['dbdriver'] = 'mysql';
//$db['shravasti_report_db']['dbprefix'] = '';
//$db['shravasti_report_db']['pconnect'] = TRUE;
//$db['shravasti_report_db']['db_debug'] = TRUE;
//$db['shravasti_report_db']['cache_on'] = FALSE;
//$db['shravasti_report_db']['cachedir'] = '';
//$db['shravasti_report_db']['char_set'] = 'utf8';
//$db['shravasti_report_db']['dbcollat'] = 'utf8_general_ci';
//$db['shravasti_report_db']['swap_pre'] = '';
//$db['shravasti_report_db']['autoinit'] = TRUE;
//$db['shravasti_report_db']['stricton'] = FALSE;
//$db['shravasti_report_db']['dbrwconfig'] = 'W';
//
//$db['school1']['hostname'] = 'localhost';
//$db['school1']['username'] = 'root';
//$db['school1']['password'] = '';
//$db['school1']['database'] = "School1";
//$db['school1']['dbdriver'] = 'mysql';
//$db['school1']['dbprefix'] = '';
//$db['school1']['pconnect'] = TRUE;
//$db['school1']['db_debug'] = TRUE;
//$db['school1']['cache_on'] = FALSE;
//$db['school1']['cachedir'] = '';
//$db['school1']['char_set'] = 'utf8';
//$db['school1']['dbcollat'] = 'utf8_general_ci';
//$db['school1']['swap_pre'] = '';
//$db['school1']['autoinit'] = TRUE;
//$db['school1']['stricton'] = FALSE;
//$db['school1']['dbrwconfig'] = 'W';

/* End of file database.php */
/* Location: ./application/config/database.php */