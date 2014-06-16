<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once ( "./application/push/Channel.class.php" ) ;
class base extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试，与你保存的格式匹配		
	}

	/**
	 *  format message to json and send(echo)
	 */
	public function render ($code, $message, $result = '')
	{
		echo json_encode(array(
			'code'		=> $code,
			'message'	=> $message,
			'result'	=> $result
		));
		exit;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////
	// protected method
	
	/**
	 * @ingore
	 */
	public function checksession()
	{
		if (!isset($_SESSION['user'])) {
			$this->render('10001', 'please login first');
		} else {
			$this->user = $_SESSION['user'];
		}
	}

	public function test(){
		echo "hello";
	}

	//=============BaiduPush===========================

	public function error_output ( $str ) 
	{
		echo "\033[1;40;31m" . $str ."\033[0m" . "\n";
	}
	
	public function right_output ( $str ) 
	{
	    echo "\033[1;40;32m" . $str ."\033[0m" . "\n";
	}


//推送android设备消息
	public function test_pushMessage_android ($tag_name)
	{
	    $apiKey = "uguu2ceydHMuEmYuxWAf2q3u";
		$secretKey = "WR3nFPGLdx3gfgIcybQ5xZG5MLivDslA";
	    $channel = new Channel ( $apiKey, $secretKey ) ;
		//推送消息到某个user，设置push_type = 1; 
		//推送消息到一个tag中的全部user，设置push_type = 2;
		//推送消息到该app中的全部user，设置push_type = 3;
		$push_type = 2; //推送单播消息
		//$optional[Channel::USER_ID] = $user_id; //如果推送单播消息，需要指定user
		$optional[Channel::TAG_NAME] = $tag_name;  //如果推送tag消息，需要指定tag_name

		//指定发到android设备
		$optional[Channel::DEVICE_TYPE] = 3;
		//指定消息类型为通知
		$optional[Channel::MESSAGE_TYPE] = 0;
		//通知类型的内容必须按指定内容发送，示例如下：
		$message = '{ 
				"title": "update",
				"description": "1",
				"custom_content": {"update":"1"},
	 		}';
		$messages = '{"update":"1"}';
		
		$message_key = "msg_key";
	    $ret = $channel->pushMessage ( $push_type, $messages, $message_key, $optional ) ;
	    if ( false === $ret )
	    {
	        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
	        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
	        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
	        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
	    }
	    else
	    {
	        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
	        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	    }
	}


	public function test_setTag($tag_name)
	{
	    $apiKey = "uguu2ceydHMuEmYuxWAf2q3u";
		$secretKey = "WR3nFPGLdx3gfgIcybQ5xZG5MLivDslA";
	    $channel = new Channel($apiKey, $secretKey);
	    //$optional[Channel::USER_ID] = $user_id;
	    $ret = $channel->setTag($tag_name);
	    if (false === $ret) {
	    	echo 'false';
	        $this->error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
	        $this->error_output ( 'ERROR NUMBER: ' . $channel->errno ( ) ) ;
	        $this->error_output ( 'ERROR MESSAGE: ' . $channel->errmsg ( ) ) ;
	        $this->error_output ( 'REQUEST ID: ' . $channel->getRequestId ( ) );
	        return false;
	    } else {   
	    	echo 'true';
	        $this->right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
	        $this->right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	        //return $ret['response_params']['tid'];
	    }
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */