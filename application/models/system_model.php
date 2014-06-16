<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Filename:System_Model.php
	Projectname:
	Date created:April 26,2014
	Created by:Will Shangru Yu
*/
class System_Model extends CI_Model
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
	function check_login($username,$password)
	{
		$accountarr = $this->select_specialrow('username',$username,'account');
		if($accountarr->num_rows()>0)
		{
			$pwd = $accountarr->result()[0]->password;
			if($pwd == $password)
			{
				return 3;
			}
			else
			{
				return 1;
			}
		} 
		else
		{
			return 2;
		}
	}
}
/*	
	End of file System_Model.php
	Location:
*/