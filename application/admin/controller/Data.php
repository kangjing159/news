<?php
namespace app\admin\controller;

use app\admin\model\MoneyModel;

class Data extends Base{

	public function list(){

		return $this->fetch();
	}

	public function details(){

		return $this->fetch();
	}

	public function add(){

        $obj = new MoneyModel;
        $data = $obj->where('type','=',0)->select();
        $this->assign('data',$data);
		return $this->fetch();
	}

	public function addsave()
    {
       // dump($_POST);exit;
    	$obj = new MoneyModel;
        if(isset($_POST['id'])){
            $result = $obj->where('id','=',$_POST['id'])->update($_POST);
        }else{
           $result = $obj->save($_POST); 
       }
    	
    	if($result){
    		$this->success('添加成功','Data/add');
    	}else{
    		$this->success('添加失败','Data/add');
    	}
        
    }
}