<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
//error_reporting(0);
/*
	Filename:RestaurantManage.php
	Projectname:
	Date created:April 29,2014
	Created by:Will Shangru Yu
*/
class RestaurantManage extends base{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		$this->load->model('Management_Model');
		session_start();
	}
	function test()
	{
		echo "11";
	}
	function MenuType()
	{
		$restaurantid = $this->input->get('restaurantid');
		if($restaurantid)
		{
			$menuarr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'menu');
			$menuid = $menuarr->result()[0]->menu_id;

			$categoryarr = $this->Management_Model->select_specialrow('menu_id',$menuid,'category');
			$categorylist = Array();
			for($i=0;$i<count($categoryarr);$i++)
			{
				$category = Array(
						"categoryid"=>$categoryarr->result()[$i]->category_id,
						"name"=>$categoryarr->result()[$i]->name,
						"description"=>$categoryarr->result()[$i]->description
					);
				array_push($categorylist, $category);
			}
			$this->render('10021', 'Select Ok',array(
						'category' => $category
				));
		}
	}
	function MenuItem()
	{
		$categoryid = $this->input->get('categoryid');
		if($categoryid)
		{
			$serverurl = $this->config->item('server_name');
			$itemarr = $this->Management_Model->select_specialrow('category_id',$categoryid,'item');
			$itemlist = Array();
			for($i=0;$i<count($itemarr->result());$i++)
			{
				$picturearr = $this->Management_Model->select_specialrow('item_id',$itemarr->result()[$i]->item_id,'picture');
				if(count($picturearr->result()))
				{
					$item = Array(
							'itemid'=>$itemarr->result()[$i]->item_id,
							'itemname'=>$itemarr->result()[$i]->name,
							'description'=>$itemarr->result()[$i]->description,
							'unit'=>$itemarr->result()[$i]->unit,
							'price'=>$itemarr->result()[$i]->price,
							'image'=>$serverurl."/image/item/".$picturearr->result()[0]->name
						);
				}
				else
				{
					$item = Array(
							'itemid'=>$itemarr->result()[$i]->item_id,
							'itemname'=>$itemarr->result()[$i]->name,
							'description'=>$itemarr->result()[$i]->description,
							'unit'=>$itemarr->result()[$i]->unit,
							'price'=>$itemarr->result()[$i]->price,
							'image'=>"null"
						);
				}
				array_push($itemlist, $item);
			}
			$this->render('10021', 'Select Ok',array(
						'itemlist' => $itemlist
				));
		}
	}
	function AddMenuItem()
	{
		$accountid = $this->input->get('accountid');
		$itemname = $this->input->post('itemname');
		$description = $this->input->post('description');
		$type = $this->input->post('type');
		$unit = $this->input->post('unit');
		$price = $this->input->post('price');
		$config['upload_path']='./image/item/';
		$config['allowed_types']='gif|png|jpg|jpeg';
		$config['file_name'] = time();
		$this->load->library('upload',$config);
		if($accountid && $itemname && $description && $type && $unit && $price
			&& $this->upload->do_upload('pic'))
		{
			$itemarr = $this->Management_Model->select_itemname($type,$itemname);
			if(count($itemarr->result()))
			{
				echo "<script>alert('item existed already!')</script>";
				echo "<script>javascript:history.back(1);</script>";
			}
			else
			{
				$data = $this->upload->data();
				$image = $data['file_name'];
				$item = array(
						'name'=>$itemname,
						'description'=>$description,
						'unit'=>$unit,
						'price'=>$price,
						'category_id'=>$type
					);
				$this->Management_Model->insert_row($item,'item');
				$itemarr = $this->Management_Model->select_itemname($type,$itemname);
				$itemid = $itemarr->result()[0]->item_id;
				$picture = array(
						'name'=>$image,
						'description'=>$description,
						'item_id'=>$itemid
					);
				$this->Management_Model->insert_row($picture,'picture');
				echo "<script>alert('insert Ok！')</script>";
				echo "<script>window.location.href='/orderonline/index.php/WebPage/mainpage'";
				echo "</script>";
			}
		}
		else
		{
			echo "<script>alert('input cannot be null')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function AddMenuType()
	{
		$accountid = $this->input->get('accountid');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		if($accountid && $name && $description)
		{
			$accountarr = $this->Management_Model->select_row($accountid,'account');
			$restaurantid = $accountarr->result()[0]->restaurant_id;
			$restaurantarr = $this->Management_Model->select_row($restaurantid,'restaurant');
			$menuid = $restaurantarr->result()[0]->menu_id;
			$category = array(
					'name'=>$name,
					'description'=>$description,
					'menu_id'=>$menuid
				);
			$this->Management_Model->insert_row($category,'category');
			echo "<script>alert('insert Ok！')</script>";
			//$url = "/orderonline/index.php/WebPage/mainpage?account=".$accountid;
			echo "<script>window.location.href='/orderonline/index.php/WebPage/mainpage'";
			echo "</script>";
		}
		else
		{
			//echo $accountid." ".$name." ".$description;
			echo "<script>alert('input cannot be null')</script>";
			echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
	}
	function DeleteMenuItem()
	{
		$itemid = $_GET['itemid'];
		$this->Management_Model->delete_row($itemid,'item');
		echo "<script>alert('delete Ok！')</script>";
		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}
	function DeleteMenuType()
	{
		$categoryid = $_GET['categoryid'];
		$this->Management_Model->delete_row($categoryid,'category');
		echo "<script>alert('delete Ok！')</script>";
		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}
	function ShopEdit()
	{
		$restaurantname = $this->input->post('restaurantname');
		$address = $this->input->post('address');
		$description = $this->input->post('description');
		$type = $this->input->post('type');
		$phone = $this->input->post('phone');
		$config['upload_path']='./image/restaurant/';
		$config['allowed_types']='gif|png|jpg|jpeg';
		$config['file_name'] = time();
		$this->load->library('upload',$config);
		if($restaurantname&&$address&&$description&&$type&&$phone
			&&$this->upload->do_upload('pic'))
		{
			$restaurantid = $_SESSION['restaurantid'];
			$restaurant = array(
					'name'=>$restaurantname,
					'address'=>$address,
					'description'=>$description,
					'type'=>$type,
					'phone'=>$phone,
				);
			$this->Management_Model->update_row($restaurantid,$restaurant,'restaurant');
			$restaurantarr = $this->Management_Model->select_row($restaurantid,'restaurant');
			$pictureid = $restaurantarr->result()[0]->picture_id;
			$data = $this->upload->data();
			$image = $data['file_name'];
			$picture = array('name'=>$image);
			$this->Management_Model->update_row($pictureid,$picture,'picture');
			echo "<script>alert('edit Ok！')</script>";
			echo "<script>window.location.href='/orderonline/index.php/WebPage/mainpage'";
			echo "</script>";
		}
		else
		{
			echo "<script>alert('missing varible！')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function AddSeat()
	{
		$tableno = $this->input->post('tableno');
		$qrcodedata = $this->input->post('qrcodedata');
		if($tableno && $qrcodedata)
		{
			$restaurantid = $_SESSION['restaurantid'];
			$tablearr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'table');
			$flag = 0;
			for($i=0;$i<count($tablearr->result());$i++)
			{
				if($tableno == $tablearr->result()[$i]->table_no)
				{
					$flag = 1;					
					break;
				}
			}
			$qrcodearr = $this->Management_Model->select_qrcode();
			for($i=0;$i<count($qrcodearr->result());$i++)
			{
				if($qrcodedata == $qrcodearr->result()[$i]->qrcode_data)
				{
					$flag = 1;					
					break;
				}
			}
			if($flag == 1)
			{
				echo "<script>alert('table existed already!')</script>";
				echo "<script>javascript:history.back(1);</script>";
			}
			else
			{
				$qrcode = array(
						'qrcode_data'=>$qrcodedata,
						'table_id'=>$restaurantid
					);
				$this->Management_Model->insert_row($qrcode,'qrcode');
				$qrcodearr = $this->Management_Model->select_specialrow('qrcode_data',$qrcodedata,'qrcode');
				$qrcodeid = $qrcodearr->result()[0]->qrcode_id;
				$table = array(
						'table_no'=>$tableno,
						'table_status'=>"vacant",
						'restaurant_id'=>$restaurantid,
						'qrcode_id'=>$qrcodeid
					);
				$this->Management_Model->insert_row($table,'table');
				$tablearr = $this->Management_Model->select_specialrow('qrcode_id',$qrcodeid,'table');
				$tableid = $tablearr->result()[0]->table_id;
				$qrcode = array('table_id'=>$tableid);
				$this->Management_Model->update_row($qrcodeid,$qrcode,'qrcode');
				echo "<script>alert('insert Ok！')</script>";
				echo "<script>window.location.href='/orderonline/index.php/WebPage/mainpage'";
				echo "</script>";
			}
		}
		else
		{
			echo "<script>alert('input cannot be null')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function EditSeat()
	{
		$tableid = $this->input->post('tableid');
		$tableno = $this->input->post('tableno');
		$qrcode = $this->input->post('qrcode');
		if($tableno&&$tableid&&$qrcode)
		{
			$restaurantid = $_SESSION['restaurantid'];
			$tablearr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'table');
			$flag = 0;
			for($i=0;$i<count($tablearr->result());$i++)
			{
				if($tableno == $tablearr->result()[$i]->table_no)
				{
					$flag = 1;					
					break;
				}
			}
			$qrcodearr = $this->Management_Model->select_qrcode();
			for($i=0;$i<count($qrcodearr->result());$i++)
			{
				if($qrcode == $qrcodearr->result()[$i]->qrcode_data)
				{
					$flag = 1;					
					break;
				}
			}
			if($flag == 1)
			{
				echo "<script>alert('table existed already!')</script>";
				echo "<script>javascript:history.back(1);</script>";
			}
			else
			{
				$table = array(
						'table_no'=>$tableno
					);
				$this->Management_Model->update_row($tableid,$table,'table');
				$tablearr = $this->Management_Model->select_row($tableid,'table');
				$qrcodeid = $tablearr->result()[0]->qrcode_id;
				$qrcode = array(
						'qrcode_data'=>$qrcode
					);
				$this->Management_Model->update_row($qrcodeid,$qrcode,'qrcode');
				echo "<script>alert('edit Ok！')</script>";
				echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			}
		}
		else
		{
			echo "<script>alert('missing varible！')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function DeleteSeat()
	{
		$tableid = $_GET['tableid'];
		$qrcodeid = $_GET['qrcodeid'];
		$this->Management_Model->delete_row($tableid,'table');
		$this->Management_Model->delete_row($qrcodeid,'qrcode');
		echo "<script>alert('delete Ok！')</script>";
		echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}
	function EditMenuItem()
	{
		$accountid = $this->input->get('accountid');
		$itemid = $this->input->post('itemid');
		$itemname = $this->input->post('itemname');
		$description = $this->input->post('description');
		$type = $this->input->post('type');
		$unit = $this->input->post('unit');
		$price = $this->input->post('price');
		$config['upload_path']='./image/item/';
		$config['allowed_types']='gif|png|jpg|jpeg';
		$config['file_name'] = time();
		$this->load->library('upload',$config);
		if($accountid && $itemname && $description && $type && $unit && $price)
		{
			$data = $this->upload->data();
			$image = $data['file_name'];
			$item = array(
						'name'=>$itemname,
						'description'=>$description,
						'unit'=>$unit,
						'price'=>$price,
						'category_id'=>$type
					);
			$this->Management_Model->update_row($itemid,$item,'item');

			$picturearr = $this->Management_Model->select_specialrow('item_id',$itemid,'picture');
			$pictureid = $picturearr->result()[0]->picture_id;
			$picture = array(
						'name'=>$image,
						'description'=>$description
					);
			$this->Management_Model->update_row($pictureid,$picture,'picture');
			//echo $accountid." ".$itemname." ".$description." ".$type." ".$unit." ".$price." ".$image ;
			echo "<script>alert('edit Ok！')</script>";
			//echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			echo "<script>window.location.href='/orderonline/index.php/WebPage/menu'";
			echo "</script>";
		}
		else
		{
			echo "<script>alert('input cannot be null')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function EditMenuType()
	{
		$accountid = $this->input->get('accountid');
		$categoryid = $this->input->post('categoryid');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		if($accountid && $categoryid && $name && $description)
		{
			$category = array(
					'name'=>$name,
					'description'=>$description
				);
			$this->Management_Model->update_row($categoryid,$category,'category');
			echo "<script>alert('edit Ok！')</script>";
			echo "<script>window.location.href='/orderonline/index.php/WebPage/menu'";
			echo "</script>";
		}
		else
		{
			echo "<script>alert('input cannot be null')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function UnservedItem()
	{
		$restaurantid = $this->input->get('restaurantid');
		//echo $accountid;
		$content="";
		$orderitemarr = $this->Management_Model->select_specialrow('item_status','cooking','orderitem');
		for($i=0;$i<count($orderitemarr->result());$i++)
		{
			$itemid = $orderitemarr->result()[$i]->item_id;
			$itemarr = $this->Management_Model->select_row($itemid,'item');
			$itemname = $itemarr->result()[0]->name;
			$quantity = $orderitemarr->result()[0]->quantity;
			//echo $itemname." ".$quantity;
			$content = $content."<tr class='odd'>";
            $content=$content."<td>".$itemname."</td>"."<td width='150'>".$quantity."</td>";
            $content=$content."<td width='100' class='center'>
                                                    <a title='修改' class='green' style='padding-right:8px;' href='../shoptype/update/7766.html'>
                                                        <i class='icon-pencil bigger-130'>
                                                        </i>
                                                    </a>
                                                    <a title='删除' class='red' style='padding-right:8px;' href='../shoptype/delete/7766.html'>
                                                        <i class='icon-trash bigger-130'>
                                                        </i>
                                                    </a>
                                                </td>";
            $content = $content."</tr>";
		}
		echo $content;
	}
	function CountSale()
	{
		$restaurantid = $_SESSION['restaurantid'];
		//$restaurantid = $_GET['restaurantid'];
		if($restaurantid)
		{
			$orderarr = $this->Management_Model->select_sale($restaurantid);
			//$timelist = array();
			if(count($orderarr->result()))
			{
				$time = $orderarr->result()[0]->last_updated;
				$arr = explode("-", $time);
				$pyear = $arr[0];
				$pmonth = $arr[1];
				$thirdarr = $arr[2];
				$arr = explode(" ",$thirdarr);
				$pday = $arr[0];
				$pdate = $pyear.$pmonth.$pday;
				$totalbill = 0;
				$temp = 0;
				$data = "[";
				for($i=0;$i<count($orderarr->result());$i++)
				{
					
					$time = $orderarr->result()[$i]->last_updated;
					$bill = $orderarr->result()[$i]->bill;
					$arr = explode("-", $time);
					$year = $arr[0];
					$month = $arr[1];
					$thirdarr = $arr[2];
					$arr = explode(" ",$thirdarr);
					$day = $arr[0];
					$date = $year.$month.$day;
					if($pdate == $date)
					{
						$totalbill = $totalbill+$bill;
					}
					if($pdate != $date && $temp<10)
					{
						$data = $data."[gd(".$pyear.",".$pmonth.",".$pday."),".$totalbill."],";
						$temp = $temp+1;
						$pyear = $year;
						$pmonth = $month;
						$pday = $day;
						$pdate = $date;
						$totalbill = 0;
						$i = $i-1;
					}
					if($temp<10 && $i == count($orderarr->result())-1)	
					{
						$data = $data."[gd(".$pyear.",".$pmonth.",".$pday."),".$totalbill."],";
						$temp = $temp+1;
					}				
				}
				$data = substr($data,0,-1);
				$data = $data."]";			
				echo $data;
			}
			else
			{
				echo "<script>alert('no record')</script>";
				echo "<script>javascript:history.back(1);</script>";
			}
		}
		else
		{
			echo "<script>alert('missing virable')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
}
/*	
	End of file RestaurantManage.php
	Location:
*/