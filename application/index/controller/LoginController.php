<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;


class LoginController extends Controller
{
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

        if (!is_null($Teacher) && $Teacher -> getData('password') === $postData['password']) {
                \session('teacherId',$Teacher->getData('id'));
                return $this->success('login success',\url('Teacher/index'));
        } else {
            return $this->error('username or password incorrect',\url('index'));
        }
        //验证密码是否正确
        //用户名密码正确，将teacherId 存Session
        //用户名密码错误，跳转到登录界面
        return 'login';
    }
}
