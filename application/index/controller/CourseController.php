<?php
namespace app\index\controller;
use app\common\model\Course;
use app\common\model\Klass;
use app\common\model\KlassCourse;
use think\Request;

class CourseController extends IndexController
{
    public function index()
    {
        //取出数据库课程
        $Course = Course::paginate();

        //赋予变量到模板
        $this->assign('courses',$Course);
        return $this->fetch();
    }

    public function add()
    {
        $this->assign('Course',new Course);

        return $this->fetch();
    }

    public function save()
    {
        $Course = new Course();
        $Course->name = Request::instance()->post('name');

        // 新增数据并验证。验证类，自己写下吧。
        if (!$Course->validate(true)->save()) {
            return $this->error('保存错误：' . $Course->getError());
        }

        //接收klass_id这个数组
        $klassIds = Request::instance()->post('klass_id/a');

        //利用klass_id数组，拼接为包括klass_id和course_id的二维数组
        if (!is_null($klassIds)) {
            if (!$Course->Klasses()->saveAll($klassIds)) {
                return $this->error('课程-班级信息保存错误：' . $Course->Klasses()->getError());
            }
        }

        unset($Course);
        return $this->success('操作成功', url('index'));
    }

    public function edit()
    {
        $id = Request::instance()->param('id/d');
        $Course = Course::get($id);

        if (\is_null($Course)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }

        $this->assign('Course', $Course);
        return $this->fetch();
    }

    public function update()
    {
        var_dump(Request::instance()->param());
    }
}
