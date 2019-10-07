<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\ZixunModel;
use app\admin\model\NewsModel;
class Index extends Controller
{
    
    public function index()
    {
    	$obj = new ZixunModel;
    	$db = new NewsModel;
    	$data = $obj->where('lang','=',$_COOKIE['think_var'])->limit(10)->order('id desc')->select();
    	$list = $db->where('lang','=',$_COOKIE['think_var'])->limit(10)->order('id desc')->select();
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
    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function lang() {
        switch ($_GET['lang']) {
            case 'vn':
                cookie('think_var', 'vn');
            break;
            case 'en':
                cookie('think_var', 'en');
            break;
            //其它语言
        }
    }
    
}
