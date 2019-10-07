<?php
namespace app\admin\controller;

//use think\captcha\Captcha;
use think\Db;
use think\Controller;
use Session;
class Common extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function check(){
    	
    	/*$captcha = new Captcha();

		if( !$captcha->check($_POST['captcha']))
		{
			$this->error('验证码错误','common/login');
		}else{*/
			$info = DB::table('user')->where('name','=',$_POST['name'])->find();
	    	if(MD5($_POST['password']) != $info['password']){
	    		$this->error('用户名或者密码错误','common/login');
	    	}else{
	    		$data = [
            		'uid' => $info['id'],
            		'user_name'=>$info['name'],
        		];
       
       			 Session::set('USER_INFO_SESSION',$data);

	    		$this->redirect('index/index');
	    	}
		//}
    }

    public function logout()
    {
       Session::clear();
       $this->redirect('common/login');
    }
    
}