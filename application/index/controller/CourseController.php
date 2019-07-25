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
            $datas = array();
            foreach ($klassIds as $klassId) {
                $data = array();
                $data['klass_id'] = $klassId;
                $data['course_id'] = $Course->id;

                array_push($datas,$data);
            }

            //利用saveAll()方法，来将二维数据存入数据库
            if (!empty($datas)) {
                $KlassCourse = new KlassCourse;
                if (!$KlassCourse->validate(true)->saveAll($datas)) {
                    return $this->error('课程-班级信息保存错误：' . $KlassCourse->getError());
                }

                unset($KlassCourse);
            }
        }

        unset($Course);
        return $this->success('操作成功', url('index'));
    }
}