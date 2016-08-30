<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\forms;


use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $rePassword;

    /**
     * @var User
     */
    private $_user;

    public function __construct(User $user, $config = [])
    {
        if ($user == null) {
            throw new InvalidParamException('必须设置 "user".');
        }

        $this->_user = $user;
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => '旧密码',
            'newPassword' => '新密码',
            'rePassword' => '重复密码',
        ];
    }

    public function rules()
    {
        return [
            // oldPassword
            ['oldPassword', 'required'],
            ['oldPassword', 'validatePassword'],

            // newPassword
            ['newPassword', 'required'],
            ['newPassword', 'string', 'min' => 6],

            // rePassword
            ['rePassword', 'required'],
            ['rePassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function validatePassword($attribute, $params = [])
    {
        if (!$this->_user->validatePassword($this->oldPassword)) {
            $this->addError($attribute, '旧密码不正确.');
        }
    }

    /**
     * 修改密码
     *
     * @return bool
     */
    public function changePassword()
    {
        if (!$this->validate()) {
            return false;
        }

        //
        $user = $this->_user;
        $user->setPassword($this->newPassword);
        $user->generateAuthKey();

        return $user->changePassword();
    }
}