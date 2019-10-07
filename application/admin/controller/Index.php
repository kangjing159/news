<?php
namespace app\admin\controller;

class Index extends Base
{
	/*function __construct() {
       $ww = Session::get('USER_INFO_SESSION');
       if(!isset($ww)){
       	$this->redirect('common/login');
       }
   }*/

    public function index()
    {
    	/*$ww = Session::get('USER_INFO_SESSION');
    	dump($ww);exit;*/
        return $this->fetch();
    }

    
}
