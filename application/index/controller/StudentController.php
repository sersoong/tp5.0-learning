<?php
namespace app\index\controller;
use app\common\model\Student;
use app\common\model\Klass;
use think\Request;

class StudentController extends IndexController 
{
    public function index()
    {
        $this->setName('student');
        //读取数据
        $students = Student::paginate();

        //显示数据
        $this->assign('students',$students);
        $this->assign('controller_name',$this->getName());
        return $this->fetch();
    }

    public function edit()
    {
        //获取传入id
        $id = Request::instance()->param('id/d');

        //判断是否存在该id的记录
        if(is_null($Student=Student::get($id))) {
            return $this->error('未找到ID为' . $id . '的记录',url('index'));
        }

        //取出studetn对象
        $this->assign('Student',$Student);
        return $this->fetch();
    }

    public function update()
    {
        //获取传入的数据
        $id = Request::instance()->post('id/d');

        //判断是否存在该id的记录
        if(is_null($Student=Student::get($id))) {
            return $this->error('未找到ID为' . $id . '的记录',url('index'));
        }

        //修改student对象
        $Student->name = Request::instance()->post('name');
        $Student->num = Request::instance()->post('num');
        $Student->sex = Request::instance()->post('sex');
        $Student->klass_id = Request::instance()->post('klass_id');
        $Student->email = Request::instance()->post('email');
        //写入student对象
        if (!$Student->validate(true)->save($Student->getData())) {
            return $this->error('更新错误:' . $Student->getError());
        } else {
            return $this->success('操作成功',url('index'));
        }
    }
}
