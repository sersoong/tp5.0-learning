<?php
namespace app\index\controller;
use think\Db;

class Teacher  
{
    public function index()
    {
        $teachers = Db::name('teacher')->select();

        echo($teachers[0]['name']);
        var_dump($teachers[0]['name']);
    }
}
