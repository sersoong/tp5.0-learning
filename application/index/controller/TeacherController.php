<?php
namespace app\index\controller;
use think\Request;//请求
use app\common\model\Teacher;//教师模型

class TeacherController extends IndexController
{
    public function index()
    {
        $this->setName('teacher');
        $name = Request::instance()->get('name');
        // echo($name);
        $pageSize=30; //每页显示30条数据

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
        $this->assign('controller_name',$this->getName());
        //加载模板
        $htmls = $this->fetch();
        //返回数据
        return $htmls;
    }

    public function insert()
    {
        //实例化Teacher空对象
        $Teacher = new Teacher();

        // $Teacher->create_time = date('Y-m-d H:i:s', time());

        $result = $this->saveTeachers($Teacher);

        // 反馈结果
        if (false === $result)
        {
            $this->error('新增失败:' . $Teacher->getError(),url('index'));
        } else {
            $this->success('新增成功。新增ID为:' . $Teacher->id,url('index'));
        }
    }

    public function add()
    {
        $Teacher = new Teacher();

        $Teacher->id = 0;
        $Teacher->name = '';
        $Teacher->username = '';
        $Teacher->sex = 0;
        $Teacher->email = '';

        $this->assign('Teacher',$Teacher);
        $htmls = $this->fetch('edit');
        return $htmls;
    }

    public function delete()
    {
        //获取传入的id值
        $id = Request::instance()->param('id/d');
        
        if(is_null($id) || 0===$id) {
            $this->error('未获取到ID信息',url('index'));
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

                // 更新
                if (false === $this->saveTeachers($Teacher,true))
                {

                    $this->error('更新失败' . $Teacher->getError(),url('index'));
                } else {
                    $this->success('更新成功',url('index'));
                }
            } else {
                $this->error('所更新的记录不存在',url('index'));
            }
    }

    private function saveTeachers(Teacher &$Teacher,$isUpdate = false)
    {
        $Teacher->name = Request::instance()->post('name');

        if(!$isUpdate){
            $Teacher->username = Request::instance()->post('username');
        }

        $Teacher->sex = Request::instance()->post('sex/d');
        $Teacher->email = Request::instance()->post('email');

        return $Teacher->validate(true)->save();
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
