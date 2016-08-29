<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */


namespace frontend\forms;


use common\helpers\DateHelper;
use common\models\User;
use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => '此邮箱地址已注册.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'email' => '邮箱',
            'password' => '密码',
            'verifyCode' => '验证码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->registerDatetime = DateHelper::now();
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}