<?php

namespace common\models;

use Yii;

/**
 * @property User $user
 */
class Auth extends BaseAuth
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

}
