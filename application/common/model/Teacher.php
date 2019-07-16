<?php
namespace app\common\model;
use think\Model;

class Teacher extends Model 
{
    static public function login($username,$password)
    {
        //验证用户是否存在
        $map = array('username'=>$username);

        $Teacher = self::get($map);

        if(!is_null($Teacher)) {
            if ($Teacher->checkPassword($password)) {
                \session('teacherId', $Teacher->getData('id'));
                return true;
            }
        }
        return false;
    }

    public function checkPassword($password)
    {
        if ($this->getData('password')===$this::encryptPassword($password)) {
            return true;
        } else {
            return false;
        }
    }

    static public function encryptPassword($password)
    {
        return sha1(\md5($password) . 'mengyunzhi');
    }
}
