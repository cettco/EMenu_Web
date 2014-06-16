<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//require_once 'push.php';
//error_reporting(0);
/*
	Filename:UserControl.php
	Projectname:
	Date created:April 24,2014
	Created by:Will Shangru Yu
*/
class UserControl extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		$this->load->model('User_Model');
		$serverurl = $this->config->item('server_name');
	}
	function test()
	{
		$arr = $this->User_Model->test(1,'restaurant');
		echo $arr[0]->name;
	}
	function CheckCode()
	{
		$qrcode = $this->input->post('qrcode');
		//$tableinfo = $this->User_Model->get_tableinfo($qrcode);
		if($qrcode)
		{
			$qrcodearr = $this->User_Model->select_row($qrcode,'qrcode');
			if(count($qrcodearr->result()))
			{
				$serverurl = $this->config->item('server_name');
				$tableid = $qrcodearr->result()[0]->table_id;
				
				$tablearr = $this->User_Model->select_row($tableid,'table');
				$tableno = $tablearr->result()[0]->table_no;
				$tablestatus = $tablearr->result()[0]->table_status;
				$restaurantid = $tablearr->result()[0]->restaurant_id;
				$orderid = $tablearr->result()[0]->order_id;

				$restaurantarr = $this->User_Model->select_row($restaurantid,'restaurant');


				$picturearr = $this->User_Model->select_row($restaurantarr->result()[0]->picture_id,'picture');
				$tableinfo = Array(
							'restaurantid'=>$restaurantid,
							'tableno'=>$tableno,
							'tablestatus'=>$tablestatus,
							'orderid'=>$orderid,
							'restaurantname'=>$restaurantarr->result()[0]->name,
							'type'=>$restaurantarr->result()[0]->type,
							'pictureurl'=>$serverurl."/image/restaurant/".$picturearr->result()[0]->name,
							'address'=>$restaurantarr->result()[0]->address,
							'description'=>$restaurantarr->result()[0]->description,
							'menuid'=>$restaurantarr->result()[0]->menu_id,
							'phone'=>$restaurantarr->result()[0]->phone				
						);
				$this->render('10021', 'select Ok!',array(
						'tableinfo' => $tableinfo
						));
			}
			else
			{
				$this->render('10020','qrcode not existed');
			}
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
	function HurryOrder()
	{
		$orderid = $this->input->get('orderid');
		if($orderid)
		{
			$time = date('Y-m-d H:i:s',time());
			$hurryarr = array(
					'order_id'=>$orderid,
					'time'=>$time
				);
			$this->User_Model->insert_row($hurryarr,'hurry');
			$this->render('10022','insert Ok!');
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
	function MyActivity()
	{
		$orderid = $this->input->post('orderid');
		//$orderid = $this->input->get('orderid');
		if($orderid)
		{
			$serverurl = $this->config->item('server_name');

			$orderarr = $this->User_Model->select_row($orderid,'order');
			$orderstatus = $orderarr->result()[0]->order_status;
			$bill = $orderarr->result()[0]->bill;
			$lastupdated = $orderarr->result()[0]->last_updated;
			$restaurantid = $orderarr->result()[0]->restaurant_id;
			$tableid = $orderarr->result()[0]->table_id;

			$restaurantarr = $this->User_Model->select_row($restaurantid,'restaurant');
			$restaurantname = $restaurantarr->result()[0]->name;

			$tablearr = $this->User_Model->select_row($tableid,'table');
			$tableno = $tablearr->result()[0]->table_no;

			$orderitemarr = $this->User_Model->select_specialrow('order_id',$orderid,'orderitem');
			$orderitemarr = $this->User_Model->select_orderitemlist($orderid);
			$orderitemlist = Array();

			for($i=0;$i<count($orderitemarr->result());$i++)
			{
				$itemid = $orderitemarr->result()[$i]->item_id;
				$itemarr = $this->User_Model->select_row($itemid,'item');
				$itemname = $itemarr->result()[0]->name;
				$itemunit = $itemarr->result()[0]->unit;
				$itemprice = $itemarr->result()[0]->price;
				$categoryid = $itemarr->result()[0]->category_id;
				$itemdishid = $itemarr->result()[0]->item_id;//add this
				$categoryarr = $this->User_Model->select_row($categoryid,'category');
				$categoryname = $categoryarr->result()[0]->name;
				$picturearr = $this->User_Model->select_specialrow('item_id',$itemid,'picture');
				if(count($picturearr->result()))
				{
					$orderitem = Array(
							'itemid'=>$itemdishid,
							'orderitemid'=>$orderitemarr->result()[$i]->orderitem_id,
							'orderitemname'=>$itemname,
							'unit'=>$itemunit,
							'price'=>$itemprice,
							'categoryname'=>$categoryname,
							'quantity'=>$orderitemarr->result()[$i]->quantity,
							'itemstatus'=>$orderitemarr->result()[$i]->item_status,
							'itemimage'=>$serverurl."/image/item/".$picturearr->result()[0]->name
						);
				}
				else
				{
					$orderitem = Array(
							'itemid'=>$itemdishid,
							'orderitemid'=>$orderitemarr->result()[$i]->orderitem_id,
							'orderitemname'=>$itemname,
							'unit'=>$itemunit,
							'price'=>$itemprice,
							'categoryname'=>$categoryname,
							'quantity'=>$orderitemarr->result()[$i]->quantity,
							'itemstatus'=>$orderitemarr->result()[$i]->item_status,
							'itemimage'=>"null"
						);
				}
				array_push($orderitemlist,$orderitem);
			}
			$activity = Array(
					'restaurantid'=>$restaurantid,
					'restaurantname'=>$restaurantname,
					'tableid'=>$tableid,
					'tableno'=>$tableno,
					'lastupdated'=>$lastupdated,
					'bill'=>$bill,
					'orderstatus'=>$orderstatus,
					'orderitem'=>$orderitemlist
				);
			$this->render('10021', 'select Ok!',array(
					'activity' => $activity
					));
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}

	function aa(){
		$this->load->helper('push');
		test_setTag('1-1');
		test_pushMessage_android('1-1');
	}

	function PlaceOrder()
	{
		$restaurantid = $this->input->post('restaurantid');
		$tableid = $this->input->post('tableid');
		$edit = $this->input->post('edit');
		$number = $this->input->post('number');
		$itemid = $this->input->post('itemid');
		if($restaurantid && $itemid && $number && $tableid && $edit)
		{
			$tagname = $restaurantid.'-'.$tableid;
			$this->load->helper('push');
			test_setTag($tagname);
			test_pushMessage_android($tagname);
			$tablearr = $this->User_Model->select_row($tableid,'table');
			$orderid = $tablearr->result()[0]->order_id;
			if($orderid)
			{
				$orderid = $tablearr->result()[0]->order_id;
			}
			else
			{
				$time = date('Y-m-d H:i:s',time());
				$order = array(
						'bill'=>0,
						'last_updated'=>$time,
						'order_status'=>"ordering",
						'restaurant_id'=>$restaurantid,
						'table_id'=>$tableid
				);
				$this->User_Model->insert_row($order,'order');
				$orderid = $this->User_Model->select_orderid($time);
				$table = array(
						'order_id'=>$orderid,
						'table_status'=>"occupied"
					);
				$this->User_Model->update_row($tableid,$table,'table');
			}
			$orderarr = $this->User_Model->select_row($orderid,'order');
			$orderstatus = $orderarr->result()[0]->order_status;
			if($orderstatus == "ordering")
			{
				if($edit == "add")
				{
					$orderitemarr = $this->User_Model->select_orderitem($orderid,$itemid);
					if(count($orderitemarr->result()))
					{
						$quantity = $orderitemarr->result()[0]->quantity;
						$orderitemid = $orderitemarr->result()[0]->orderitem_id;
						$orderitem = array(
								'quantity'=>$quantity + $number
							);
						$this->User_Model->update_row($orderitemid,$orderitem,'orderitem');
						
						$itemarr = $this->User_Model->select_row($itemid,'item');
						$price = $itemarr->result()[0]->price;
						$orderarr = $this->User_Model->select_row($orderid,'order');
						$bill = $orderarr->result()[0]->bill;
						$order = array(
								'bill'=>$bill+$price*$number
							);
						$this->User_Model->update_row($orderid,$order,'order');
						$this->render('10022','quantity adds '.$number);
						//echo "1";
					}
					else
					{
						$orderitem = array(
								'quantity'=>$number,
								'item_status'=>"cooking",
								'item_id'=>$itemid,
								'order_id'=>$orderid
							);
						$this->User_Model->insert_row($orderitem,'orderitem');

						$itemarr = $this->User_Model->select_row($itemid,'item');
						$price = $itemarr->result()[0]->price;
						$orderarr = $this->User_Model->select_row($orderid,'order');
						$bill = $orderarr->result()[0]->bill;
						$order = array(
								'bill'=>$bill+$price*$number
							);
						$this->User_Model->update_row($orderid,$order,'order');

						$this->render('10022','insert Ok!');
						//echo "2";
					}
				}
				if($edit == "delete")
				{
					$orderitemarr = $this->User_Model->select_orderitem($orderid,$itemid);
					if(count($orderitemarr->result()))
					{
						$quantity = $orderitemarr->result()[0]->quantity;
						$orderitemid = $orderitemarr->result()[0]->orderitem_id;
						if($quantity > $number)
						{
							$orderitem = array(
									'quantity'=>$quantity - $number
								);
							$this->User_Model->update_row($orderitemid,$orderitem,'orderitem');

							$itemarr = $this->User_Model->select_row($itemid,'item');
							$price = $itemarr->result()[0]->price;
							$orderarr = $this->User_Model->select_row($orderid,'order');
							$bill = $orderarr->result()[0]->bill;
							$order = array(
									'bill'=>$bill-$price*$number
								);
							$this->User_Model->update_row($orderid,$order,'order');

							$this->render('10022','quantity reduces '.$number);
						echo "5";
						}
						else
						{
							$this->User_Model->delete_row($orderitemid,'orderitem');

							$itemarr = $this->User_Model->select_row($itemid,'item');
							$price = $itemarr->result()[0]->price;
							$orderarr = $this->User_Model->select_row($orderid,'order');
							$bill = $orderarr->result()[0]->bill;
							$order = array(
									'bill'=>$bill-$price*$quantity
								);
							$this->User_Model->update_row($orderid,$order,'order');
							
							$this->render('10022','orderitem deleted');
							//echo "6";
						}
					}
					else
					{
						$this->render('10022','orderitem not exited!');
					}
				}
			}
			else
			{
				$this->render('10022','order has been finished!');
			}
			//echo " orderid=".$orderid;
		}
		else
		{
			$this->render('10024','missing variable');
		}
	}
	// function PlaceOrder()
	// {
	// 	echo "q";
		// $restaurantid = $this->input->get('restaurantid');
		// $tableid = $this->input->get('tableid');
		// $edit = $this->input->get('edit');
		// //$orderid = $this->input->post('orderid');
		// $number = $this->input->get('number');
		// $itemid = $this->input->get('itemid');
		// echo "1";
		// //if(isset($_POST['orderitem']) && $restaurantid && $tableid)

		// if($restaurantid && $itemid && $number && $tableid && $edit)
		// {	
		// 	echo "1";
			//$orderitemarr = $this->User_Model->select_orderitem(1,$itemid);
			//$orderarr = $this->User_Model->select_pendingorder($restaurantid,$tableid);		
			// if(count($orderarr->result()))
			// {
			// 	$orderid = $orderarr->result()[0]->order_id;
			//  	echo "1";
			// }
			// else
			// {
			// echo "2";
				// $time = date('Y-m-d H:i:s',time());
				// $order = array(
				// 		'bill'=>0,
				// 		'last_updated'=>$time,
				// 		'order_status'=>"pending",
				// 		'restaurant_id'=>$restaurantid,
				// 		'table_id'=>$tableid
				// );
				// $this->User_Model->insert_row($order,'order');
				// $orderid = $this->User_Model->select_orderid($time);
				// $table = array(
				// 		'order_id'=>$orderid,
				// 		'table_status'=>"occupied"
				// 	);
				// $this->User_Model->update_row($tableid,$table,'table');
			//}
			// if($edit == "add")
			// {
				// $orderitemarr = $this->User_Model->select_orderitem($orderid,$itemid);
				// if(count($orderitemarr->result()))
				// {
				// 	echo "3";
					// $quantity = $orderitemarr->result()[0]->quantity;
					// $orderitemid = $orderitemarr->result()[0]->orderitem_id;
					// $orderitem = array(
					// 		'quantity'=>$quantity + $number
					// 	);
					// $this->User_Model->update_row($orderitemid,$orderitem,'orderitem');
					
					// $itemarr = $this->User_Model->select_row($itemid,'item');
					// $price = $itemarr->result()[0]->price;
					// $orderarr = $this->User_Model->select_row($orderid,'order');
					// $bill = $orderarr->result()[0]->bill;
					// $order = array(
					// 		'bill'=>$bill+$price*$number;
					// 	);
					// $this->User_Model->update_row($orderid,$order,'order');
					// $this->render('10022','quantity adds '.$number);
				// }
				// else
				// {
					// $orderitem = array(
					// 		'quantity'=>$number,
					// 		'item_status'=>"cooking",
					// 		'item_id'=>$itemid,
					// 		'order_id'=>$orderid
					// 	);
					// $this->User_Model->insert_row($orderitem,'orderitem');

					// $itemarr = $this->User_Model->select_row($itemid,'item');
					// $price = $itemarr->result()[0]->price;
					// $orderarr = $this->User_Model->select_row($orderid,'order');
					// $bill = $orderarr->result()[0]->bill;
					// $order = array(
					// 		'bill'=>$bill+$price*$number;
					// 	);
					// $this->User_Model->update_row($orderid,$order,'order');

					// $this->render('10022','insert Ok!')
			// 		echo "4";
			// 	}
				
			// }
			// if($edit == "delete")
			// {
			// 	$orderitemarr = $this->User_Model->select_orderitem($orderid,$itemid);
			// 	if(count($orderitemarr->result()))
			// 	{
					// $quantity = $orderitemarr->result()[0]->quantity;
					// $orderitemid = $orderitemarr->result()[0]->orderitem_id;
					// if($quantity > $number)
					// {
					// 	$orderitem = array(
					// 			'quantity'=>$quantity - $number
					// 		);
					// 	$this->User_Model->update_row($orderitemid,$orderitem,'orderitem');

					// 	$itemarr = $this->User_Model->select_row($itemid,'item');
					// 	$price = $itemarr->result()[0]->price;
					// 	$orderarr = $this->User_Model->select_row($orderid,'order');
					// 	$bill = $orderarr->result()[0]->bill;
					// 	$order = array(
					// 			'bill'=>$bill-$price*$number;
					// 		);
					// 	$this->User_Model->update_row($orderid,$order,'order');

					// 	$this->render('10022','quantity reduces '.$number);
					//echo "5";
					//}
					//else
					//{
						// $this->User_Model->delete_row($orderitemid,'orderitem');

						// $itemarr = $this->User_Model->select_row($itemid,'item');
						// $price = $itemarr->result()[0]->price;
						// $orderarr = $this->User_Model->select_row($orderid,'order');
						// $bill = $orderarr->result()[0]->bill;
						// $order = array(
						// 		'bill'=>$bill-$price*$quantity;
						// 	);
						// $this->User_Model->update_row($orderid,$order,'order');
						
						// $this->render('10022','orderitem deleted');
						//echo "6";
					//}
				//}
				//else
				//{
					//$this->render('10022','orderitem not exited!');
		// 		//}
		// 	}
		// }
		// else
		// {
		// 	$this->render('10024','missing variable'.$restaurantid." ".$itemid." ".$number." ".$tableid." ".$edit);
		// }
	//}
	function FinishOrder()
	{
		$tableid = $this->input->post('tableid');
		if($tableid)
		{
			$tablearr = $this->User_Model->select_row($tableid,'table');
			$orderid = $tablearr->result()[0]->order_id;
			if($orderid)
			{
				$orderarr = $this->User_Model->select_row($orderid,'order');
				$orderstatus = $orderarr->result()[0]->order_status;
				if($orderstatus == "ordering")
				{
					$orderarr = array(
							'order_status'=>"pending"
						);
					$this->User_Model->update_row($orderid,$orderarr,'order');
					$this->render('10022','confirm Ok!');
				}
				else
				{
					$this->render('10020','order has been confirmed');
				}
			}
			else
			{
				$this->render('10020','order not existed');
			}
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
	function WaitForDeal()
	{
		$orderid = $this->input->post('orderid');
		if($orderid)
		{
			$orderarr = $this->User_Model->select_row($orderid,'order');
			$orderstatus = $orderarr->result()[0]->order_status;
			$order = Array(
					'orderstatus'=>$orderstatus
				);
			$this->render('10021','select Ok!',array(
					'order'=> $order
				));
		}
		else
		{
			$this->render('10020','missing variable');
		}
	}
}
/*	
	End of file UserControl.php
	Location:
*/
