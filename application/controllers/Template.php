<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//error_reporting(0);
/*
	Filename:.php
	Projectname:
	Date created:April 24,2014
	Created by:Will Shangru Yu
*/
class Template extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		//$this->load->model('ClientInfo_Model');
	}
}
/*	
	End of file .php
	Location:
*/