<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\VideoModel;

class Video extends Controller
{
    public function index()
    {
    	$db = new VideoModel;
    	//$newest = $db->oreder('id desc')->select();
    	$newest = $db->where('lang','=',$_COOKIE['think_var'])->order('id desc')->limit(3)->select();
    	$tp_new = $db->where('lang','=',$_COOKIE['think_var'])->group('type')->select();
    	$this->assign('newest',$newest);
    	//$this->assign('newest4',$newest4);
    	$this->assign('tp_new',$tp_new);
    	//dump($tp_new);exit;
        return $this->fetch();
    }

    public function details()
    {
    	$db = new VideoModel;
    	$info = $db->where('id','=',$_GET['id'])->find();
    	$data = $db->where('type','=',$info['type'])->order('id desc')->select();
    	$this->assign('data',$data);
    	$this->assign('info',$info);
        return $this->fetch();
    }
    
}
