<?php
namespace app\admin\controller;

use think\Controller;
use Session;
class Base extends Controller
{
	function initialize() {
       if(!Session::get('USER_INFO_SESSION')){
       	$this->redirect('common/login');
       }
   }
}   