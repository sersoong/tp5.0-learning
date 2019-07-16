<?php
namespace app\index\controller;

use app\common\model\Teacher;
use think\Controller;


class LogoutController extends Controller
{
    //注销
    public function index()
    {
        if (Teacher::logOut()) {
            return $this->success('logout success',url('login/index'));
        } else {
            return $this->error('logout failed');
        }
    }
}
