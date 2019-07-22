<?php

namespace app\common\validate;

use think\Validate;

class Student extends Validate
{
    protected $rule = [
        'name'  => 'require|length:2,25',
        'sex' => 'in:0,1',
        'klass_id'=> 'require',
        'email' => 'email',
    ];
}