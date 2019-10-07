<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\NewsModel;
class Information extends Controller
{
    public function index()
    {
    	$db = new NewsModel;
    	$list = $db->where('lang','=',$_COOKIE['think_var'])->limit(6)->order('id desc')->select();
    	$result = [];
    	for ($i=0; $i < 3; $i++) { 
             $where = [
                ['lang','=',$_COOKIE['think_var']],
                ['type','=',$i]
            ];
    		$result[$i]= $db->where($where)->order('id desc')->limit(6)->select();
    	}
    	//dump($result);exit;
    	$this->assign('list',$list);
    	$this->assign('result',$result);
        return $this->fetch();
    }

    public function details()
    {
    	$db = new NewsModel;
    	$info = $db->where('id','=',$_GET['id'])->find();
    	$data = $db->where('type','=',$info['type'])->limit(6)->order('id desc')->field('id,title')->select();

    	//dump($data);exit;
    	$this->assign('data',$data);
    	$this->assign('info',$info);
        return $this->fetch();
    }

    
}
