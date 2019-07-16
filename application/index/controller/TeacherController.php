<?php
namespace app\index\controller;
use think\Request;//请求
use app\common\model\Teacher;//教师模型

class TeacherController extends IndexController
{
    public function index()
    {
        $name = Request::instance()->get('name');

        $pageSize=5; //每页显示5条数据

        //创建Teacher 实例
        $Teacher = new Teacher;

        //// 按条件查询数据并调用分页
        $teachers = $Teacher->where('name','like','%' . $name . '%')->paginate($pageSize,false,[
            'query'=>[
                'name' => $name,
            ],
        ]);
        //给模板变量teachers赋值
        $this->assign('teachers',$teachers);
        //加载模板
        $htmls = $this->fetch();
        //返回数据
        return $htmls;
    }

    public function insert()
    {
        //接收传入数据
        $postData = Request::instance()->post();
        //实例化Teacher空对象
        $Teacher = new Teacher();

        //为对象属性赋值
        $Teacher->name = $postData['name'];
        $Teacher->username = $postData['username'];
        $Teacher->sex = $postData['sex'];
        $Teacher->email = $postData['email'];
        $Teacher->create_time = date('Y-m-d H:i:s', time());

        $result = $Teacher->validate(true)->save($Teacher->getData());

        // $Teacher->save();
        // var_dump($Teacher->save());
        // 反馈结果
        if (false === $result)
        {
            return '新增失败:' . $Teacher->getError();
        } else {
            return  '新增成功。新增ID为:' . $Teacher->id;
        }

    }

    public function add()
    {
        $htmls = $this->fetch();
        return $htmls;
    }

    public function test()
    {
        $data = array();
        $data['username'] = '';
        $data['name'] = '1';
        $data['sex'] = '1';
        $data['email'] = 'hello@hello.com';
        var_dump($this->validate($data,'Teacher'));
    }
}
