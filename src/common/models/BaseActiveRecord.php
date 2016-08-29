<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BaseActiveRecord extends ActiveRecord
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => $this->hasAttribute('createdAt') ? 'createdAt' : false,
            'updatedAtAttribute' => $this->hasAttribute('updatedAt') ? 'updatedAt' : false
        ];
        return $behaviors;
    }
}