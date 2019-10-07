<?php
namespace app\admin\controller;

use app\admin\model\ZixunModel;

class Article extends Base
{
    /*function __construct() {
       if(is_null(Session::get('USER_INFO_SESSION'))){
        $this->redirect('common/login');
       }
   }*/
   
    public function index()
    {
    	$obj = new ZixunModel;
    	$data = $obj->select();
    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function add()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        if ($_GET){
            /*$id = $_GET['id'];
            dump($id);exit;*/
            $obj = new ZixunModel;
            $info = $obj->where('id','=',$_GET['id'])->find();
            //dump($info);exit;
            $this->assign('info',$info);
            return $this->fetch();
        }else{
            return $this->fetch();
        }
    }

    public function addsave()
    {
       // dump($_POST);exit;
    	$obj = new ZixunModel;
    	$_POST['time'] = date("H:i:s");
        if($_POST['id'] != ''){
            $result = $obj->where('id','=',$_POST['id'])->update($_POST);
        }else{
           $result = $obj->save($_POST); 
        }
    	
    	if($result){
    		$this->success('添加成功','Article/index');
    	}else{
    		$this->success('添加失败','Article/index');
    	}
        
    }

    public function del()
    {
    	$id = json_decode($_POST['id'],true);
    	$obj = new ZixunModel;
    	$result = $obj->where('id','=',$id)->delete();
    	return $result;

        
    }
}
