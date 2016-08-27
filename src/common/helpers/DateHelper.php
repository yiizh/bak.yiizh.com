<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\helpers;


class DateHelper
{
    /**
     * 当前时间
     *
     * @return string
     */
    public static function now()
    {
        return date('Y-m-d H:i:s');
    }

}