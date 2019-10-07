<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\ViewpointModel;

class viewpoint extends Controller
{
    public function index()
    {
    	$db = new ViewpointModel;
        $where1 = [
                ['lang','=',$_COOKIE['think_var']],
                ['recommend','=',1]
            ];
    	$recommend = $db->where($where1)->order('id desc')->limit(2)->select();
    	$ranking = $db->where('lang','=',$_COOKIE['think_var'])->order('num desc')->limit(8)->select();
    	$data = $db->where('lang','=',$_COOKIE['think_var'])->limit(8)->select();
    	$result = [];
    	for ($i=0; $i < 3; $i++) { 
            $where = [
                ['lang','=',$_COOKIE['think_var']],
                ['type','=',$i]
            ];
    		$result[$i]= $db->where($where)->order('id desc')->limit(8)->select();
    	}
    	//dump($result);exit;
    	$this->assign('result',$result);
    	$this->assign('data',$data);
    	$this->assign('recommend',$recommend);
    	$this->assign('ranking',$ranking);
        return $this->fetch();
    }
    public function rank(){
        $db = new ViewpointModel;
        $now = time();
        if($_GET['butto'] == 'week'){

            $begin = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));
             $where = [
                ['lang','=',$_COOKIE['think_var']],
                ['time','>',$begin],
                ['time','<',$now]
            ];
            $ranking = $db->where($where)->order('num desc')->limit(8)->select();
        }else{
           $begin = mktime(0,0,0,date('m'),date('d')-2,date('y'));
           $where = [
                ['lang','=',$_COOKIE['think_var']],
                ['time','>',$begin],
                ['time','<',$now]
            ];
            $ranking = $db->where($where)->order('num desc')->limit(8)->select();
        }
       return json_encode($ranking);
     
    }
    public function details()
    {
    	$db = new ViewpointModel;
    	$info = $db->where('id','=',$_GET['id'])->find();
    	$data = $db->where('type','=',$info['type'])->order('id desc')->limit(6)->field('id,title')->select();
    	$this->assign('data',$data);
    	$this->assign('info',$info);
        return $this->fetch();
    }
    
}
