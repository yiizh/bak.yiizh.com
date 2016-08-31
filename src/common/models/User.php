<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\helpers\Url;
use yii\log\Logger;
use yii\web\IdentityInterface;

class User extends BaseUser implements IdentityInterface
{
    const STATUS_ACTIVE = 100;
    const STATUS_LOCKED = 0;

    const SCENARIO_PROFILE = 'profile';
    const SCENARIO_PASSWORD = 'password';

    public static $statusItems = [
        self::STATUS_ACTIVE => '激活',
        self::STATUS_LOCKED => '锁定'
    ];

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_PROFILE] = ['avatar', 'name', 'updatedAt'];
        $scenarios[self::SCENARIO_PASSWORD] = ['passwordHash'];

        return $scenarios;
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() == $authKey;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    /**
     * 保存个人资料
     *
     * @return bool
     */
    public function saveProfile()
    {
        if (!$this->save()) {
            return false;
        }
        return true;
    }

    /**
     * 修改密码
     *
     * @return bool
     */
    public function changePassword()
    {
        if (!$this->save()) {
            return false;
        }
        return true;
    }

    /**
     * 头像地址
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        if ($this->avatar == null) {
            return Url::to('@web/static/images/default-avatar.jpg');
        } else {
            return Url::to('@web' . $this->avatar);
        }
    }

    /**
     * @param string $authclient
     * @return bool
     */
    public function hasBind($authclient)
    {
        return Auth::find()
            ->andWhere(['source' => $authclient, 'userId' => $this->id])
            ->exists();
    }

    /**
     * 取消绑定第三方帐号
     *
     * @param string $authclient
     * @return bool
     */
    public function unbind($authclient)
    {
        $tr = self::getDb()->beginTransaction();

        try {
            Auth::deleteAll(['source' => $authclient, 'userId' => $this->id]);
            if ($this->hasAttribute($authclient)) {
                $this->$authclient = null;
                if (!$this->save()) {
                    $tr->rollBack();
                    return false;
                }
            }
            $tr->commit();
            return true;
        } catch (\Exception $e) {
            Yii::getLogger()->log($e->getMessage(), Logger::LEVEL_ERROR);
            $tr->rollBack();
            return false;
        }
    }
}