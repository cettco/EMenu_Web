<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//error_reporting(0);
/*
	Filename:ClientServer.php
	Projectname:
	Date created:April 24,2014
	Created by:Will Shangru Yu
*/
class ClientServer extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		$this->load->model('ClientInfo_Model');
	}
	function MenuItemList()
	{
		$categoryid = $this->input->post('categoryid');
		if($categoryid)
		{
			$serverurl = $this->config->item('server_name');
			$query = $this->ClientInfo_Model->select_menuitemlist($categoryid);
			$menuitemlist = Array();
			for($i=0;$i<count($query->result());$i++)
			{
				$picquery = $this->ClientInfo_Model->select_specialrow('item_id',$query->result()[$i]->item_id,'picture');
				if(count($picquery->result()))
				{
					$menuarr = Array(
								"itemid"=>$query->result()[$i]->item_id,
								"itemname"=>$query->result()[$i]->name,
								"itemunit"=>$query->result()[$i]->unit,
								"itemprice"=>$query->result()[$i]->price,
								"description"=>$query->result()[$i]->description,
								"picture"=>$serverurl."/image/item/".$picquery->result()[0]->name
						);
				}
				else
				{
					$menuarr = Array(
								"itemid"=>$query->result()[$i]->item_id,
								"itemname"=>$query->result()[$i]->name,
								"itemunit"=>$query->result()[$i]->unit,
								"itemprice"=>$query->result()[$i]->price,
								"description"=>$query->result()[$i]->description,
								"picture"=>"null"
						);
				}
				array_push($menuitemlist,$menuarr);
			}
			$this->render('10021', 'Select Ok',array(
						'menuitemlist' => $menuitemlist
				));
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
	function MenuList()
	{
		$menuid = $this->input->post('menuid');
		if($menuid)
		{
			$query = $this->ClientInfo_Model->select_categorylist($menuid);
			$menulist = Array();
			for($i=0;$i<count($query->result());$i++)
			{
				$menuarr = Array(
							"categoryid"=>$query->result()[$i]->category_id,
							"categoryname"=>$query->result()[$i]->name,
							"description"=>$query->result()[$i]->description
					);
				array_push($menulist,$menuarr);
			}
			$this->render('10021', 'Select Ok',array(
						'menulist' => $menulist
				));
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
	function RestaurantList()
	{
		$restaurantid = $this->input->post('restaurantid');
		$type = $this->input->post('type');
		if($type)
		{
			$serverurl = $this->config->item('server_name');
			$query = $this->ClientInfo_Model->select_restaurantlist($restaurantid,$type);
			$restaurantlist = Array();
			for($i=0;$i<count($query->result());$i++)
			{
				$picturearr = $this->ClientInfo_Model->select_row($query->result()[$i]->picture_id,'picture');
				if(count($picturearr->result()))
				{
					$restaurantarr = Array(
							"restaurantid"=>$query->result()[$i]->restaurant_id,
							"restaurantname"=>$query->result()[$i]->name,
							"type"=>$query->result()[$i]->type,
							"phone"=>$query->result()[$i]->phone,
							"pictureurl"=>$serverurl."/image/restaurant/".$picturearr->result()[0]->name,
							"address"=>$query->result()[$i]->address,
							"description"=>$query->result()[$i]->description,
							"menuid"=>$query->result()[$i]->menu_id
					);
				}
				else
				{
					$restaurantarr = Array(
							"restaurantid"=>$query->result()[$i]->restaurant_id,
							"restaurantname"=>$query->result()[$i]->name,
							"type"=>$query->result()[$i]->type,
							"phone"=>$query->result()[$i]->phone,
							"pictureurl"=>"null",
							"address"=>$query->result()[$i]->address,
							"description"=>$query->result()[$i]->description,
							"menuid"=>$query->result()[$i]->menu_id
					);
				}
				array_push($restaurantlist, $restaurantarr);
			}
			$this->render('10021', 'Select Ok',array(
						'restaurantlist' => $restaurantlist
				));
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
}
/*	
	End of file ClientServer.php
	Location:
*/