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
        $Course = Course::paginate();

        //赋予变量到模板
        $this->assign('courses',$Course);
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
        $Course = new Course();
        $Course->name = Request::instance()->post('name');

        // 新增数据并验证。验证类，自己写下吧。
        if (!$Course->validate(true)->save()) {
            return $this->error('保存错误：' . $Course->getError());
        }

        return $this->success('操作成功', url('index'));

        var_dump(Request::instance()->param());
    }
}
