<?php
namespace app\admin\controller;

//use think\Controller;
use app\admin\model\CatalogModel;
use think\Db;
use Env;
//use Session;

class Catalog extends Base
{

    /*function __construct() {
       $ww = Session::get('USER_INFO_SESSION');
       if(!$ww){
        $this->redirect('common/login');
       }
   }*/
   
    public function index()
    {

        $obj = new CatalogModel;
        $data = $obj->select();
        $root = Env::get('root_path');
        //echo $root;exit;
        $this->assign('root',$root);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function type_list(){
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $data = Db::table('catalog_type')
                    ->select();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function type_add(){
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
         if ($_GET){
            $info = Db::table('catalog_type')
                    ->where('id','=',$_GET['id'])
                    ->find();
            $this->assign('info',$info);
            return $this->fetch();        
         }else{
            return $this->fetch();
         }
        
    }

    public function type_addsave(){
        if($_POST['id'] != ''){
            $result = Db::table('catalog_type')
                    ->where('id','=',$_POST['id'])
                    ->update($_POST);
        }else{
           $result = Db::table('catalog_type')
                    ->insert($_POST); 
        }
        if($result){
            $this->success('添加成功','Catalog/type_add');
        }else{
            $this->success('添加失败','Catalog/type_add');
        }            
    }

    public function type_del()
    {   
        //return $_POST;exit;
        $id = json_decode($_POST['id'],true);
        $result = Db::table('catalog_type')->where('id','=',$id)->delete();
        return $result;
    }

    public function add()
    {
        //dump($_GET);exit;
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $type[0] = Db::table('catalog_type')->where('type','=',1)->select();
        $type[1] = Db::table('catalog_type')->where('type','=',2)->select();
        if ($_GET){
            /*$id = $_GET['id'];
            dump($id);exit;*/
            $obj = new CatalogModel;
            $info = $obj->where('id','=',$_GET['id'])->find();
            //dump($info);exit;
            $this->assign('type',$type);
            $this->assign('info',$info);
            return $this->fetch();
        }else{
            
           // dump($type);exit;
            $this->assign('type',$type);
            return $this->fetch();
        }
        
    }

    public function addsave()
    {
        $file = request()->file('img');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( '../public/uploads');
        if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
        $_POST['imgurl'] = $info->getSaveName();
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
       
        }else{
        // 上传失败获取错误信息
        echo $file->getError();
        }
        $obj = new CatalogModel;
        if($_POST['id'] != ''){
            $result = $obj->where('id','=',$_POST['id'])->update($_POST);
        }else{
           $result = $obj->save($_POST); 
        }
        if($result){
            $this->success('添加成功','Catalog/index');
        }else{
            $this->success('添加失败','Catalog/add');
        }
        
    }

    public function del()
    {   
        //return $_POST;exit;
        $id = json_decode($_POST['id'],true);
        $obj = new CatalogModel;
        $result = $obj->where('id','=',$id)->delete();
        return $result;

        
    }
}
