<?php
namespace app\index\controller;
use app\common\model\Student;

class StudentController extends IndexController 
{
    public function index()
    {
        //读取数据
        $students = Student::paginate();

        //显示数据
        $this->assign('students',$students);
        return $this->fetch();
    }
}
