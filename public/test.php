<?php
class Test  
{
    public function test()
    {
        var_dump(Hebuter::isSchoolMoreThan100());

        $Hebuter = new Hebuter;
        $xiaohong = $Hebuter::get('xiaohong');
        $xiaoming = $Hebuter::get('xiaoming');

        var_dump($xiaohong->whatIsYourId());
        var_dump($xiaoming->whatIsYourId());
    }
}



class Hebuter  
{
    private $name; //姓名

    //设置姓名
    public function setName($name)
    {
        $this->name = $name;
    }

    //学校是否有百年历史
    static public function isSchoolMoreThan100()
    {
        return true;
    }

    //获取ID信息
    public function whatIsYourId()
    {
        if($this->name === 'xiaoming'){
            return '1234567';
        }

        if ($this->name==='xiaohong'){
            return '7654321';
        }

        return '8888888';
    }

    //根据名字获取Hebuter对象
    static public function get($name)
    {
        $Hebuter = new Hebuter;
        $Hebuter->setName($name);
        return $Hebuter;
    }
}

$Test = new Test; //实例化Test
$Test->test(); //调用对象方法
