<?php
namespace app\admin\controller;

use app\admin\model\VideoModel;

class Video extends Base{

	public function index()
	{
		$obj = new VideoModel;
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
            $obj = new VideoModel;
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
		$obj = new VideoModel;
    	$_POST['time'] = date("Y-m-d");
        if($_POST['id'] != ''){
            $result = $obj->where('id','=',$_POST['id'])->update($_POST);
        }else{
        	//dump($_POST);exit;
           $result = $obj->save($_POST); 
        }
    	
    	if($result){
    		$this->success('添加成功','video/index');
    	}else{
    		$this->success('添加失败','video/add');
    	}
		
	}

	public function del()
    {
    	$id = json_decode($_POST['id'],true);
    	$obj = new VideoModel;
    	$result = $obj->where('id','=',$id)->delete();
    	return $result;

        
    }
}