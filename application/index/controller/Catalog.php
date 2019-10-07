<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\CatalogModel;
use think\Db;

class Catalog extends Controller
{
    public function index()
    {
        $where1 = [
                ['lang','=',$_COOKIE['think_var']],
                ['type','=',1]
            ];
        $where2 = [
                ['lang','=',$_COOKIE['think_var']],
                ['type','=',2]
            ];
        $type[0] = Db::table('catalog_type')->where($where1)->field('id,title')->select();
        $type[1] = Db::table('catalog_type')->where($where2)->field('id,title')->select();
        $obj = new CatalogModel;
        if(isset($_POST['pid'])){
            $where = [
                ['lang','=',$_COOKIE['think_var']],
                ['pid','=',$_POST['pid']],
                ['tid','=',$_POST['tid']]
            ];
            $data = $obj->where($where)->order('id desc')->limit(6)->select();
            return json_encode($data);
        }else{
        $data = $obj->where('lang','=',$_COOKIE['think_var'])->order('id desc')->limit(6)->select();
        //dump($type);exit;
        $this->assign('data',$data);
        $this->assign('type',$type);
        return $this->fetch(); 
        }
    	
        
    }
    public function cook(){
        $where = [
                ['lang','=',$_COOKIE['think_var']],
                ['pid','=',$_GET['pid']],
                ['tid','=',$_GET['tid']]
            ];
            $obj = new CatalogModel;
            $data = $obj->where($where)->order('id desc')->limit(6)->select();
            dump($data);
    }

    public function details()
    {
    	$db = new CatalogModel;
    	$info = $db->where('id','=',$_GET['id'])->find();
    	//$data = $db->where('type','=',$info['type'])->limit(6)->order('id desc')->field('id,title')->select();

    	//dump($data);exit;
    	//$this->assign('data',$data);
    	$this->assign('info',$info);
        return $this->fetch();
    }
    
}
