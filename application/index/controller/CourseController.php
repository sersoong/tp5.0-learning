<?php
namespace app\index\controller;
use app\common\model\Course;
use app\common\model\Klass;
use think\Request;

class CourseController extends IndexController
{
    public function index()
    {
        //取出数据库课程
        return $this->fetch();
    }

    public function add()
    {
        $klasses = Klass::all();
        $this->assign('klasses',$klasses);

        return $this->fetch();
    }

    public function save()
    {
        var_dump(Request::instance()->param());
    }
}
