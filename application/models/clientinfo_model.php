<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Filename:ClientInfo_Model.php
	Projectname:
	Date created:April 24,2014
	Created by:Will Shangru Yu
*/
class ClientInfo_Model extends CI_Model
{
	function  __construct()
	{
		parent::__construct();
		$this->load->database();
		date_default_timezone_set('PRC');
	}
	function select_restaurantlist($restaurantid,$type)
	{
		if($type == "all")
		{
			$restaurantlistarr = $this->db->query("select* from restaurant where restaurant_id > '".$restaurantid."' limit 0,10");
		}
		else
		{
			$restaurantlistarr = $this->db->query("select* from restaurant where type='".$type."'
				 	and restaurant_id > '".$restaurantid."' limit 0,10");
		}
		return $restaurantlistarr;
	}
	function select_categorylist($menuid)
	{
		$categoryarr = $this->db->query("select* from category where menu_id = '".$menuid."'");
		return $categoryarr;
	}
	function select_menuitemlist($categoryid)
	{
		$menuitemarr = $this->db->query("select* from item where category_id = '".$categoryid."'");
		return $menuitemarr;
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
}
/*	
	End of file ClientInfo_Model.php
	Location:
*/