<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\MoneyModel;
use think\Db;

class Data extends Controller
{
    public function index()
    {
    	
        $where1 = [
                ['lang','=',$_COOKIE['think_var']],
                ['type','=',0]
            ];
        $top = Db::table('money_data')
                    ->field('id,title')
                    ->where( $where1)
                    ->select();
        //dump($top);exit;
        $data = [];
        foreach ($top as $k => $v) {
            //dump($v);exit;
            $where1 = [
                ['lang','=',$_COOKIE['think_var']],
                ['type','=',$v['id']]
            ];
            $info = Db::table('money_data')
            ->where($where1)
            ->field('id,title')
            ->select();
           $data[$v['title']] = $info;
        }
       /* dump($data);exit;
        $data = [];
      foreach ($top as $key => $value) {
        //dump($value);exit;
          $type[]=$value['id'];
      }
      
      foreach ($type as $v) {
        $data = $db->where('type','>',0)->select();
        }
        dump($data);exit;*/
    	//$this->assign('top',$top);
    	$this->assign('data',$data);
        return $this->fetch();
    }

    public function details(){

        return $this->fetch();
    }

    
}
