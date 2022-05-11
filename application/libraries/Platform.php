<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Platform {

	protected $_ci;
    
    function __construct(){
        $this->_ci = &get_instance();
    }
    
	function agent(){
		$this->_ci->load->library('user_agent');
        if ($this->_ci->agent->is_browser())
        {
            $agent = $this->_ci->agent->browser().' '.$this->_ci->agent->version();
        }
        elseif ($this->_ci->agent->is_robot())
        {
            $agent = $this->_ci->agent->robot();
        }
        elseif ($this->_ci->agent->is_mobile())
        {
            $agent = $this->_ci->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }
        return $agent." ".$this->_ci->agent->platform();
    }
}
