<?php
namespace app\index\controller;
use app\common\model\Teacher;
use app\common\model\Klass;
use think\Request;

class KlassController extends IndexController
{
    public function index()
    {
        $Klasses = Klass::paginate();
        $this->assign('klasses',$Klasses);
        return $this->fetch();
    }

    public function add()
    {
        //获取所有教师信息
        $teachers = Teacher::all();
        $this->assign('teachers',$teachers);
        return $this->fetch();
    }

    public function save()
    {
        //实例化请求信息
        $Request = Request::instance();
        
        //实例化班级并赋值
        $Klass = new Klass();
        $Klass->name = $Request->post('name');
        $Klass->teacher_id = $Request->post('teacher_id/d');

        //添加数据
        if(!$Klass->validate(true)->save($Klass->getData())){
            return $this->error('数据添加错误：' . $Klass->getError());
        }

        return $this->success('操作成功',url('index'));
    }
}
