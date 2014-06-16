<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//error_reporting(0);
/*
	Filename:RestaurantOrder.php
	Projectname:
	Date created:May 5,2014
	Created by:Will Shangru Yu
*/
class RestaurantOrder extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		$this->load->model('Management_Model');
	}
	function ConfirmOrder()
	{
		session_start();
		$orderid = $_SESSION['orderid'];
		$orderarr = $this->Management_Model->select_row($orderid,'order');
		$status = $orderarr->result()[0]->order_status;
		$time = date('Y-m-d H:i:s',time());
		if($status == "pending")
		{
			$order = array(
					'order_status'=>"confirmed",
					'last_updated'=>$time
				);
			$this->Management_Model->update_row($orderid,$order,'order');
		}
		if($status == "confirmed")
		{
			$order = array(
					'order_status'=>"finished",
					'last_updated'=>$time
				);
			$this->Management_Model->update_row($orderid,$order,'order');
		}
		if($status == "finished")
		{
			$table = array(
					'order_id'=>0,
					'table_status'=>"vacant"
				);
			$tablearr = $this->Management_Model->select_specialrow('order_id',$orderid,'table');
			$tableid = $tablearr->result()[0]->table_id;
			$this->Management_Model->update_row($tableid,$table,'table');
		}
		
		echo "<script>alert('deal ok！')</script>";
		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		// echo "<script>javascript:history.back(1);</script>";
		// echo "<script language=JavaScript> location.replace(location.href);</script>";
	}
	function ServedItem()
	{
		$orderitemid = $this->input->get('orderitemid');
		$orderitem = array(
				'item_status'=>"served"
			);
		$this->Management_Model->update_row($orderitemid,$orderitem,'orderitem');
		echo "<script>alert('deal ok！')</script>";
		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}
	function ExportOrder()
	{

	}
	function FinashOrder()
	{

	}
	function OrderDetail()
	{

	}
	function SeatStatus()
	{
		
	}
}
/*	
	End of file RestaurantOrder.php
	Location:
*/