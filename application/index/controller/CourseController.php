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
        $this->setName('course');
        //取出数据库课程
        $Course = Course::all();
        $array_course = array();
        foreach ($Course as $key =>$course) {
            $courses['id'] = $course->getData('id');
            $courses['name'] = $course->getData('name');
            $klassIds = $course->KlassCourses()->where('course_id',$courses['id'])->column('klass_id');
            $course_names = array();
            foreach ($klassIds as $key =>$klassid) {
                $course_name_array = $course->Klasses()->where('id',$klassid)->column('name');
                array_push($course_names,\implode('',$course_name_array)) ;
            }
            $courses['klass_names']=implode(',',$course_names);
            array_push($array_course,$courses);
        }
        // var_dump($array_course);
        // {$klasscourse->render()}
        //赋予变量到模板
        $this->assign('array_course',$array_course);
        $this->assign('controller_name',$this->getName());
        return $this->fetch();
    }

    public function add()
    {
        $this->assign('Course',new Course);

        return $this->fetch();
    }

    public function save()
    {
        // var_dump(Request::instance()->post());
        // return;
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
        //获取当前课程
        $id=Request::instance()->post('id/d');
        if (is_null($Course = Course::get($id))) {
            return $this->error('不存在ID为'.$id.'的记录');
        }

        //更新课程名
        $Course->name = Request::instance()->post('name');
        if (is_null($Course->validate(true)->save())) {
            return $this->error('课程信息更新发生错误：'.$Course->getError());
        }

        //删除原有信息
        $map = ['course_id'=>$id];

        if(false===$Course->KlassCourses()->where($map)->delete()) {
            return $this->error('删除班级课程关联信息发生错误' . $Course->KlassCourse()->getError());
        }

        //增加新增数据，执行添加操作
        $klassIds = Request::instance()->post('klass_id/a');
        if (!is_null($klassIds)) {
            if (!$Course->Klasses()->saveAll($klassIds)) {
                return $this->error('课程-班级信息保存错误：'. $Course->Klasses()->getError());
            }
        }

        return $this->success('更新成功',url('index'));
    }
}
