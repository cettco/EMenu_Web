<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
/*
	Filename:SystemManage.php
	Projectname:
	Date created:April 26,2014
	Created by:Will Shangru Yu
*/
class SystemManage extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配	
		date_default_timezone_set('PRC');
		$this->load->model('System_Model');
	}
	function Login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$checkresult = $this->System_Model->check_login($username,$password);
		//echo $username." ".$password;
		if($checkresult == 1)
		{
			//echo "password is incorrect！";
			echo "<script>alert('password is incorrect！')</script>";
			echo "<script>javascript:history.back(1);</script>";
			//exit();
		}
		if($checkresult == 2)
		{
			//echo "usrname not existed!";
			echo "<script>alert('usrname not existed!')</script>";
			echo "<script>javascript:history.back(1);</script>";
			//exit();
		}
		if($checkresult == 3)
		{
			// $accountarr = $this->System_Model->select_specialrow('username',$username,'account');
			// $account = Array(
			// 			"accountid"=>$accountarr->result()[0]->account_id,
			// 			"restaurantid"=>$accountarr->result()[0]->restaurant_id,
			// 			"status"=>$accountarr->result()[0]->status
			// 	);
			//echo "login Ok!";
			$accountarr = $this->System_Model->select_specialrow('username',$username,'account');
			$accountid = $accountarr->result()[0]->account_id;
			$restaurantid = $accountarr->result()[0]->restaurant_id;
			session_start();
			$_SESSION['accountid'] = $accountid;
			$_SESSION['restaurantid'] = $restaurantid;
			echo "<script>alert('login Ok!')</script>";
			echo "<script>window.location.href='/orderonline/index.php/WebPage/mainpage'";
			echo "</script>";
			//return $account;
		}
	}
	function ChangePwd()
	{
		$accountid = $this->input->get('accountid');
		$oldpwd = $this->input->post('oldpwd');
		$newpwd = $this->input->post('newpwd');
		$confirmpwd = $this->input->post('confirmpwd');
		if($accountid && $oldpwd && $newpwd)
		{
			if($confirmpwd != $newpwd)
			{
				echo "<script>alert('the new password is incorrect！')</script>";
				echo "<script>javascript:history.back(1);</script>";
				exit;
			}
			$accountarr = $this->System_Model->select_row($accountid,'account');
			$password = $accountarr->result()[0]->password;
			if($password == $oldpwd)
			{
				$account = Array("password"=>$newpwd);
				$this->System_Model->update_row($accountid,$account,'account');
				echo "<script>alert('Change Ok！')</script>";
				//$url = "/orderonline/index.php/WebPage/mainpage?account=".$accountid;
				echo "<script>window.location.href='/orderonline/index.php/WebPage/mainpage?accountid=".$accountid."'";
				echo "</script>";
			}
			else
			{
				echo "<script>alert('the old password is incorrect！')</script>";
				echo "<script>javascript:history.back(1);</script>";
			}
		}
		else
		{
			echo "<script>alert('missing varible！')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
	function GetBackPwd()
	{
		$accountid = $this->input->post('accountid');
		$question = $this->input->post('question');
		$answer = $this->input->post('answer');
		if($accountid && $question && $answer)
		{
			$accountarr = $this->System_Model->select_row($accountid,'account');
			if($question == $accountarr->result()[0]->question)
			{
				if($answer == $accountarr->result()[0]->answer)
				{
					echo "<script>alert('answer Ok!')</script>";
				}
				else
				{
					echo "<script>alert('answer is incorrect')</script>";
				}
			}
			else
			{
				echo "<script>alert('question is incorrect')</script>";
			}
		}
		else
		{
			echo "<script>alert('input is not enough')</script>";
		}
	}
	function ResetPwd()
	{
		$accountid = $this->input->post('accountid');
		$newpwd = $this->input->post('newpwd');
		if($accountid && $newpwd)
		{
			$account = Array("password"=>$newpwd);
			$this->System_Model->update_row($accountid,$account,'account');
			echo "<script>alert('reset Ok!')</script>";
		}
		else
		{
			echo "<script>alert('input is not enough')</script>";
		}
	}
	function UserRegister()
	{
		$username = $this->input->post('username');
		$checkresult = $this->System_Model->check_login($username,0);
		if($checkresult == 2)
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');
			
			$restaurantname = $this->input->post('restaurantname');
			$address = $this->input->post('address');
			$description = $this->input->post('description');
			$type = $this->input->post('type');
			$phone = $this->input->post('phone');
			$config['upload_path']='./image/restaurant/';
			$config['allowed_types']='gif|png|jpg|jpeg';
			$config['file_name'] = time();
			$this->load->library('upload',$config);
			if($email&&$password&&$question&&$answer&&$restaurantname&&$address&&$description&&$type
				&&$this->upload->do_upload('pic'))
			{
				$account = Array(
						"username"=>$username,
						"password"=>$password,
						"email"=>$email,
						"question"=>$question,
						"answer"=>$answer,
						"status"=>"Normal"
					);
				$this->System_Model->insert_row($account,'account');
				$accountarr = $this->System_Model->select_specialrow('username',$username,'account');
				$accountid = $accountarr->result()[0]->account_id;
				
				$restaurant = Array(
						"name"=>$restaurantname,
						"address"=>$address,
						"description"=>$description,
						"type"=>$type,
						"account_id"=>$accountid,
						"phone"=>$phone
					);
				$this->System_Model->insert_row($restaurant,'restaurant');
				$restaurantarr = $this->System_Model->select_specialrow('account_id',$accountid,'restaurant');
				$restaurantid = $restaurantarr->result()[0]->restaurant_id;

				$time = date('Y-m-d H:i:s',time());
				$menu = Array(
						"last_modified"=>$time,
						"restaurant_id"=>$restaurantid
					);
				$this->System_Model->insert_row($menu,'menu');
				$menuarr = $this->System_Model->select_specialrow('restaurant_id',$restaurantid,'menu');
				$menuid = $menuarr->result()[0]->menu_id;
				
				$restaurant = Array("menu_id"=>$menuid);
				$this->System_Model->update_row($restaurantid,$restaurant,'restaurant');

				$account = Array("restaurant_id"=>$restaurantid);
				$this->System_Model->update_row($accountid,$account,'account');
				$data = $this->upload->data();
				$image = $data['file_name'];
				$picture = Array(
						"name"=>$image,
						"description"=>$description,
						"restaurant_id"=>$restaurantid
					);
				$this->System_Model->insert_row($picture,'picture');
				$picturearr = $this->System_Model->select_specialrow('restaurant_id',$restaurantid,'picture');
				$pictureid = $picturearr->result()[0]->picture_id;
				$restaurant = Array("picture_id"=>$pictureid);
				$this->System_Model->update_row($restaurantid,$restaurant,'restaurant');
				echo "<script>alert('login Ok!')</script>";
				echo "<script>window.location.href='/orderonline/index.php/WebPage/login'";
				echo "</script>";
			}
			else
			{
				echo "<script>alert('missing varible！')</script>";
				echo "<script>javascript:history.back(1);</script>";
			}
		}
		else
		{
			echo "<script>alert('username existed')</script>";
			echo "<script>javascript:history.back(1);</script>";
		}
	}
}
/*	
	End of file SystemManage.php
	Location:
*/