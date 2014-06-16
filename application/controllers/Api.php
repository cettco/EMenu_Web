<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//error_reporting(0);
/*
	Filename:Api.php
	Projectname:
	Date created:May 3,2014
	Created by:Will Shangru Yu
*/
class Api extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		//$this->load->model('ClientInfo_Model');
	}
	function showapi()
	{
		echo "服务器地址：ysrwill.vicp.cc:8080/orderonline/index.php/</br>
		客户端接口：</br>
		扫二维码获取用户餐桌餐厅信息usercontrol/checkcode 参数qrcode(二维码)</br>
		催单usercontrol/hurryorder 参数orderid</br>
		获取当前活动usecontrol/myactivity 参数orderid</br>
		下订单usercontrol/placeorder 参数restaurantid tableid edit(delete add) number itemid</br>
		查看订单是否受理usercontrol/waitfordeal 参数orderid</br>
		获取菜目usercontrol/MenuItemList 参数categoryid</br>
		获取餐厅菜目类别usercontrol/MenuList 参数menuid</br>
		获取餐厅列表usercontrol/RestaurantList 参数type restaurantid(当前列表最后id,首次请求0)</br>
		确认订单usercontrol/FinishOrder 参数tableid";
	}
}
/*	
	End of file Api.php
	Location:
*/