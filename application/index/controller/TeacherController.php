<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
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
        $postData = Request::instance()->post();
        var_dump($postData);
        return;
        //实例化Teacher空对象
        $Teacher = new Teacher();

        //为对象属性赋值
        $Teacher->name = '马六';
        $Teacher->username = 'maliu';
        $Teacher->sex = '1';
        $Teacher->email = 'maliu@qq.com';

        //执行对象的插入数据操作
        var_dump($Teacher->save());
        return $Teacher->name . '成功增加到数据库。新增ID为：' . $Teacher->id;

    }

    public function add()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
}
