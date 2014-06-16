<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//error_reporting(0);
/*
	Filename:WebPage.php
	Projectname:
	Date created:May 4,2014
	Created by:Will Shangru Yu
*/
class WebPage extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		//$this->load->model('ClientInfo_Model');
		$this->load->model('Management_Model');
	}
	function login()
	{
		$this->load->view('login');
	}
	function mainpage()
	{
		$this->load->view('index');
	}
	function tableorder()
	{
		$this->load->view('tableorder');
	}
	function test()
	{
		$this->load->view('test');
	}
	function menu()
	{
		$this->load->view('menu');
	}
	function menuitemnew()
	{
		$this->load->view('menuitemnew');
	}
	function menuitemedit()
	{
		$this->load->view('menuitemedit');
	}
	function categorynew()
	{
		$this->load->view('categorynew');
	}
	function categoryedit()
	{
		$this->load->view('categoryedit');
	}
	function reminder()
	{
		$this->load->view('reminder');
	}
	function changepwd()
	{
		$this->load->view('changepasswd');
	}
	function tablemanagement()
	{
		$this->load->view('tablemanagement');
	}
	function tablecreate()
	{
		$this->load->view('tablecreate');
	}
	function tableedit()
	{
		$this->load->view('tableedit');
	}
	function register()
	{
		$this->load->view('register');
	}
	function ordereditem()
	{
		$this->load->view('ordereditem');
	}
	function statistic()
	{
		$this->load->view('statistic');
	}
	function shopmanagement()
	{
		$this->load->view('shopmanagement');
	}
}
/*	
	End of file WebPage.php
	Location:
*/