<?php
namespace app\common\model;
use think\Model;

class Course extends Model
{
    public function Klasses()
    {
        return $this->belongsToMany('Klass', \config('database.prefix') . 'klass_course');
    }

    public function getIsChecked(Klass &$Klass) 
    {
        //取课程ID
        $courseId = (int)$this->id;
        $klassId = (int)$Klass->id;

        //定制查询条件
        $map = array();
        $map['klass_id'] = $klassId;
        $map['course_id'] = $courseId;

        //从关联表中取信息
        $KlassCourse = KlassCourse::get($map);
        if (is_null($KlassCourse)) {
            return false;
        } else {
            return true;
        }
        //有记录，返回true;没记录，返回false
    }
}
