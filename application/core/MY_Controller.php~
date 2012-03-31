<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	var $syslog_enabled = false;
	var $syslog_msg = array();
		
	function __construct()
	{
		parent::__construct();
		//$this->_init_syslog_msg();
		//$this->_create_syslog_msg();
	}

	private function _init_syslog_msg()
	{
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
			//if uri_string set to '/' to make searching easier
			$url = trim(uri_string());
			if($url == '')
			{
				$url = '/';
			}
		       	$this->syslog_msg['Request.url'] = $url;
		       	$this->syslog_msg['Request.method'] = $_SERVER['REQUEST_METHOD'];
			$this->syslog_msg['Request.ip'] = $this->input->ip_address();
			//setup request headers
			//foreach ($_SERVER as $key => $value)
			foreach ($this->input->request_headers() as $key => $value)
			{
				if($key != 'Cookie' || $this->config->item('syslog_cookies') === true)
				{
					$this->syslog_msg["Request.$key"] = $value;
				}
			}
			//request vars
			$requestvars = '[';
			foreach($_GET as $key => $value)
			{
				if( $requestvars != '[')
				{
					$requestvars .= ',';
				}
				$requestvars .= $key . '=' . $value ;
			}
			$requestvars .= ']';
			$this->syslog_msg['Request.vars'] = $requestvars;
			//session data
			if($this->config->item('syslog_session_data') === true)
			{
				$this->load->library('session');
				$requestsession = '[';
				foreach($this->session->all_userdata() as $key => $value)
				{
					if( $requestsession != '[')
					{
						$requestsession .= ',';
					}
					$requestsession .= $key . '=' . $value ;
				}
				$requestsession .= ']';
				$this->syslog_msg['Request.session'] = $requestsession;
			}
			//setup request body
			$requestbody = '[';
			foreach($_POST as $key => $value)
			{
				if( $requestbody != '[')
				{
					$requestbody .= ',';
				}
				$requestbody .=  $key . '=' . $value ;
			}
			$requestbody .= ']';
			$this->syslog_msg['Request.body'] = $requestbody;
		}
	}
	
	private function _update_key($key, $value)
	{
		$this->syslog_msg[$key] = $value;
	}
	
	private function _create_syslog_msg()
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
}
?>
