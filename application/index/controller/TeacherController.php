<?php
namespace app\index\controller;
use think\Request;//请求
use app\common\model\Teacher;//教师模型

class TeacherController extends IndexController
{
    public function index()
    {
        $name = Request::instance()->get('name');

        $pageSize=30; //每页显示5条数据

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

    public function delete()
    {
        //获取传入的id值
        $id = Request::instance()->param('id/d');
        
        if(is_null($id) || 0===$id) {
            $this->error('未获取到ID信息');
        }

        //获取要删除的对象
        $Teacher = Teacher::get($id);
    
        //删除对象
        if(is_null($Teacher)) {
            return $this->error('找不到该教师的ID：'. $Teacher->getError(),url('index'));
        } 

        if (!$Teacher->delete()){
            return $this->error('删除失败:' . $Teacher->getError());
        }

        return $this->success('删除成功',url('index'));
    }

    public function edit()
    {
        // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 在Teacher表模型中获取当前记录
        if (is_null($Teacher = Teacher::get($id))) {
            $this->error('系统未找到ID为' . $id . '的记录',url('index'));
        } 
        
        // 将数据传给V层
        $this->assign('Teacher', $Teacher);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }

    public function update()
    {
            // 接收数据，获取要更新的关键字信息
            $id = Request::instance()->post('id/d');

            // 获取当前对象
            $Teacher = Teacher::get($id);

            if (!is_null($Teacher)) {
                // 写入要更新的数据
                $Teacher->name = Request::instance()->post('name');
                $Teacher->username = Request::instance()->post('username');
                $Teacher->sex = Request::instance()->post('sex/d');
                $Teacher->email = Request::instance()->post('email');

                // 更新
                if (false === $Teacher->validate(true)->save())
                {

                    $this->error('更新失败' . $Teacher->getError(),url('index'));
                } else {
                    $this->success('更新成功',url('index'));
                }
            } else {
                $this->error('所更新的记录不存在',url('index'));
            }
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
