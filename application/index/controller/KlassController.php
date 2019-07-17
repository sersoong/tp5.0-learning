<?php
namespace app\index\controller;
use app\common\model\Klass;

class KlassController extends IndexController
{
    public function index()
    {
        $Klasses = Klass::paginate();
        $this->assign('klasses',$Klasses);
        return $this->fetch();
    }
}
