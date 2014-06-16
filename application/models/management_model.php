<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Filename:Management_Model.php
	Projectname:
	Date created:April 29,2014
	Created by:Will Shangru Yu
*/
class Management_Model extends CI_Model
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
	function select_orderid($tableid)
	{
		$tablearr = $this->db->query("select* from order where table_id = '".$tableid."'
		 and order_status = 'pending'");
		return $tablearr;
	}
	function select_hurry($orderid)
	{
		$hurryarr = $this->db->query("select* from hurry where order_id = '".$orderid."'
		 and newhurry = 0");
		return $hurryarr;
	}
	function select_itemname($categoryid,$itemname)
	{
		$itemarr = $this->db->query("select* from item where category_id = '".$categoryid."'
		 and name = '".$itemname."'");
		return $itemarr;
	}
	function update_row($id,$arr,$table)
	{
		$idname = $table."_id";
		$this->db->where($idname,$id);
		$this->db->update($table,$arr);
	}
	function insert_row($arr,$table)
	{
		$this->db->insert($table,$arr);
	}
	function delete_row($id,$table)
	{
		$idname = $table."_id";
		$this->db->where($idname,$id);
		$this->db->delete($table);
	}
	function select_sale($restaurantid)
	{
		$orderarr = $this->db->query("SELECT * FROM  `order` WHERE  `restaurant_id` ='".$restaurantid."' order by last_updated desc");
				  // order by order_id desc limit 0,10");
		return $orderarr;
	}
	function select_qrcode()
	{
		$qrcodearr = $this->db->query("select* from qrcode");
		return $qrcodearr;
	}
}
/*	
	End of file Management_Model.php
	Location:
*/