<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Log extends CI_Log {
        private $enable_syslog = false; 
        private $appname = 'app';

        public function __construct()
        {   
                parent::__construct();
                require_once(APPPATH . 'config/syslog.php');
                if($config['syslog_enabled'] === true && $config['syslog_enable_logging'] === true)
                {   
                        $this->enable_syslog = true;
                }   
                $this->appname = $config['syslog_appname'];
        }   

        public function write_log($level = 'error', $msg, $php_error = FALSE)
        {   
                if($this->enable_syslog === true)
                {   
                        //check if loggable error level
                        $level = strtoupper($level);
                        if ( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
                        {   
                                return FALSE;
                        }   
                        openlog($this->appname, LOG_CONS | LOG_NDELAY | LOG_PID, LOG_USER | LOG_PERROR);
                        $log_msg = $level . ' ';
                        if($php_error)
                        {   
                                $log_msg = 'PHP-ERROR ';
                        }   
                        $log_msg .= $msg;
                        syslog(LOG_INFO,$log_msg);
                        closelog();
                        return true;
                }   
                else
                {
                        return parent::write_log($level, $msg, $php_error);
                }
        }

}

