<?php
namespace app\index\controller;
use app\common\model\Teacher as SmallTeacher;

class Teacher
{
    public function index()
    {
        $SmallTeacher = new SmallTeacher;
        dump($SmallTeacher);
    }
}
