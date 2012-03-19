<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	var $syslog_enabled = false;
	var $syslog_msg = array();
		
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		//load config
		$this->config->load('syslog');
		//set variable
		if($this->config->item('syslog_enabled') === true)
		{
			$this->syslog_enabled = true;
		}
		//if syslog enabled, start message
		if($this->syslog_enabled)
		{
			//setup basic info
			//$this->syslog_msg['Request.date'] = date ('m-d-Y h:i:s');  datetime saved by syslog
		       	$this->syslog_msg['Request.url'] = uri_string();
			$this->syslog_msg['Request.status'] = 200;
			//setup request headers
			//foreach ($_SERVER as $key => $value)
			foreach ($this->input->request_headers() as $key => $value)
			{
				if($key != 'Cookie' || $this->config->item('syslog_cookies') === true)
				{
					$this->syslog_msg["Request.$key"] = $value;
				}
			}
			//setup request body
			$requestbody = '[';
			foreach($_POST as $key => $value)
			{
				if( $requestbody != '[')
				{
					$requestbody .= ',';
				}
				$requestbody .= '"' . $key . '"="' . $value . '"';
			}
			$requestbody .= ']';
			$this->syslog_msg['Request.body'] = $requestbody;
			$this->_create_syslog_msg();
		}
	}
	
	function _update_key($key, $value)
	{
		$this->syslog_msg[$key] = $value;
	}
	
	function _create_syslog_msg()
	{
		openlog('php', LOG_CONS | LOG_NDELAY | LOG_PID, LOG_USER | LOG_PERROR);
		$log_msg = '';
		foreach($this->syslog_msg as $key => $value)
		{
			$log_msg .= " $key=$value";
		}
		syslog(LOG_INFO,$log_msg);
		closelog();
	}


	function __destruct()
	{
		log_message('debug','in here');
		if($this->syslog_enabled)
		{
			//create message
			$this->_create_syslog_msg();
		}
	}
}
?>
