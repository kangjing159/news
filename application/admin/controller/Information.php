<?php
namespace app\admin\controller;

//use think\Controller;
use app\admin\model\NewsModel;
use Env;
//use Session;

class Information extends Base
{

    /*function __construct() {
       $ww = Session::get('USER_INFO_SESSION');
       if(!$ww){
        $this->redirect('common/login');
       }
   }*/
   
    public function index()
    {

    	$obj = new NewsModel;
    	$data = $obj->select();
    	$root = Env::get('root_path');
    	//echo $root;exit;
    	$this->assign('root',$root);
    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function add()
    {
    	//dump($_GET);exit;
    	error_reporting(E_ERROR | E_WARNING | E_PARSE);
    	if ($_GET){
    		/*$id = $_GET['id'];
    		dump($id);exit;*/
    		$obj = new NewsModel;
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
    	if(!empty($_FILES['img']['name'])){
            //echo $_FILES['img']['name'];exit;
            $file = request()->file('img');
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->move( '../public_html/uploads');
            if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            $_POST['imgurl'] = $info->getSaveName();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
           
            }else{
            // 上传失败获取错误信息
            echo $file->getError();
            }
        }else{
            $_POST['imgurl'] = $_POST['img'];
        }
        
        unset($_POST['img']);
    	$obj = new NewsModel;
    	$_POST['time'] = date("Y-m-d h:i:s");
    	if($_POST['id'] != ''){
            $result = $obj->where('id','=',$_POST['id'])->update($_POST);
        }else{
           $result = $obj->save($_POST); 
        }
    	if($result){
    		$this->success('添加成功','information/index');
    	}else{
    		$this->success('添加失败','information/add');
    	}
        
    }

    public function del()
    {	
    	//return $_POST;exit;
    	$id = json_decode($_POST['id'],true);
    	$obj = new NewsModel;
    	$result = $obj->where('id','=',$id)->delete();
    	return $result;

        
    }
}
