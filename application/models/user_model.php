<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Filename:User_Model.php
	Projectname:
	Date created:April 24,2014
	Created by:Will Shangru Yu
*/
class User_Model extends CI_Model
{
	function  __construct()
	{
		parent::__construct();
		$this->load->database();
		date_default_timezone_set('PRC');
	}

	function test($id,$table)
	{
		if($table == "restaurant")
		{
			$tableid = $table.'_id';
		}
		$query = $this->db->query("select* from $table where ".$tableid." ='".$id."'");
		return $query->result();
	}

	function get_tableinfo($qrcode)
	{
		$this->db->where('qrcode_data',$qrcode);
		$this->db->select('*');
		$qrcodearr = $this->db->get('qrcode');
		$tableid = $qrcodearr->result()[0]->table_id;

		$tablearr = $this->select_order($tableid);
		$tableno = $tablearr->result()[0]->table_no;
		$tablestatus = $tablearr->result()[0]->table_status;
		$restaurantid = $tablearr->result()[0]->restaurant_id;
		$orderid = $tablearr->result()[0]->order_id;

		$this->db->where('restaurant_id',$restaurantid);
		$this->db->select('*');
		$restaurantarr = $this->db->get('restaurant');
		$restaurantname = $restaurantarr->result()[0]->name;

		$tableinfo = Array(
					'restaurantid'=>$restaurantid,
					'restaurantname'=>$restaurantname,
					'tableno'=>$tableno,
					'tablestatus'=>$tablestatus,
					'orderid'=>$orderid					
				);
		return $tableinfo;
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
	function select_orderid($time)
	{
		$this->db->where('last_updated',$time);
		$this->db->select('*');
		$orderarr = $this->db->get('order');
		$orderid = $orderarr->result()[0]->order_id;
		return $orderid;
	}
	function select_orderitem($orderid,$itemid)
	{
		$orderitemarr = $this->db->query("select * from orderitem where order_id='".$orderid."' 
			and item_id = '".$itemid."'");
		return $orderitemarr;
	}
	function select_orderitemlist($orderid)
	{
		$orderitemarr = $this->db->query("select* from orderitem where order_id = '".$orderid."'");
		return $orderitemarr;
	}
	function select_orderingorder($restaurantid,$tableid)
	{
		$orderarr = $this->db->query("SELECT * FROM  `order` WHERE  `order_status` =  'ordering'
		AND  `table_id` =".$tableid." AND  `restaurant_id` =".$restaurantid."");
		return $orderarr;
	}
	function insert_row($arr,$table)
	{
		$this->db->insert($table,$arr);
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
	function delete_row($id,$table)
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
		$this->db->delete($table);
	}
}
/*	
	End of file User_Model.php
	Location:
*/