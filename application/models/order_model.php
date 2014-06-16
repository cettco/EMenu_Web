<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Filename:Order_Model.php
	Projectname:
	Date created:May 5,2014
	Created by:Will Shangru Yu
*/
class Order_Model extends CI_Model
{
	function  __construct()
	{
		parent::__construct();
		$this->load->database();
		date_default_timezone_set('PRC');
	}
	function select_row($id,$table)
	{
		if($table == "qrcode")
		{
			$idname = "qrcode_data";
		}
		else
		{
			$idname = $table."_id";
		}
		$this->db->where($idname,$id);
		$this->db->select('*');
		$arr = $this->db->get($table);
		return $arr;
	}
	function select_specialrow($idname,$id,$table)
	{
		$this->db->where($idname,$id);
		$this->db->select('*');
		$arr = $this->db->get($table);
		return $arr; 
	}
	function update_row($id,$arr,$table)
	{
		if($table == "qrcode")
		{
			$idname = "qrcode_data";
		}
		else
		{
			$idname = $table."_id";
		}
		$this->db->where($idname,$id);
		$this->db->update($table,$arr);
	}
	function insert_row($arr,$table)
	{
		$this->db->insert($table,$arr);
	}
}
/*	
	End of file Order_Model.php
	Location:
*/