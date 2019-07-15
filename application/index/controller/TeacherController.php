<?php
namespace app\index\controller;
use think\Controller;

use app\common\model\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        //创建Teacher 实例
        $Teacher = new Teacher;
        //查询所有Teacher数据
        $teachers = $Teacher->select();
        //给模板变量teachers赋值
        $this->assign('teachers',$teachers);
        //加载模板
        $htmls = $this->fetch();
        //返回数据
        return $htmls;
    }

    public function insert()
    {
        //新建测试数据
        $teacher = array();
        $teacher['name'] = '王五';
        $teacher['username'] = 'wangwu';
        $teacher['sex'] = '1';
        $teacher['email'] = 'wangwu@qq.com';

        //引用teacher数据表对应的模型
        $Teacher = new Teacher();
        
        //插入数据并判断结果
        $state = $Teacher->data($teacher)->save();
        var_dump($state);
    }
}
