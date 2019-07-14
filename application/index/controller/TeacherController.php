<?php
namespace app\index\controller;
use think\Controller;

use app\common\model\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $Teacher = new Teacher;
        $teachers = $Teacher->select();

        $this->assign('teachers',$teachers);

        $htmls = $this->fetch();

        return $htmls;
    }
}
