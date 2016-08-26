<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\widgets;


class LoginPanel extends Panel
{
    public $title = '登录';

    public function renderBody()
    {
        echo $this->render('login');
    }
}