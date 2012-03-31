<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Syslog Base Config
|--------------------------------------------------------------------------
|
|  syslog_enabled = set to true if you want to log to syslog otherwise will 
|  		    just use built in logging
|
|  syslog_appname = application name to be displayed in log
|
|  syslog_cookies = set to true if you want your cookie info logged
|
|  syslog_session_date = set to true if you session vars stored in log
|
|  syslog_enable_logging = set to true if you log_messages to be stored in log
|
*/

//general syslog
$config['syslog_enabled']       = true;
$config['syslog_appname']       = 'development-app';

//generated data
$config['syslog_cookies']       = false;
$config['syslog_session_data']  = true;

//override ci logging
$config['syslog_enable_logging'] = true;

?>
