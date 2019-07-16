<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;


class LoginController extends Controller
{
    //测试函数
    public function test()
    {
        $hello = ['123'];
        echo(Teacher::encryptPassword($hello));
    }

    //用户登录表单
    public function index()
    {
        //显示登录表单

        $htmls = $this->fetch();
        return $htmls;
    }

    //处理用户提交的登录数据
    public function login()
    {
        //接收post信息
        $postData = Request::instance()->post();
        
        //验证用户名是否存在
        $map = array('username'=>$postData['username']);
        $Teacher = Teacher::get($map);

        //验证密码是否正确
        if (Teacher::login($postData['username'],$postData['password'])) {
                return $this->success('login success',\url('Teacher/index'));
        } else {

            //用户名密码错误，跳转到登录界面
            return $this->error('username or password incorrect',\url('index'));
        }

    }

    //注销
    public function logout()
    {
        if (Teacher::logOut()) {
            return $this->success('logout success',url('index'));
        } else {
            return $this->error('logout failed');
        }
    }
}
