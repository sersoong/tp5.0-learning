<?php
namespace app\common\model;
use think\Model;

class Course extends Model
{
    public function Klasses()
    {
        return $this->belongsToMany('Klass', \config('database.prefix') . 'klass_course');
    }
}
