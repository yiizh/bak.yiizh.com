<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $authKey
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property integer $status
 * @property string $registerDatetime
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseUser extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'authKey', 'passwordHash'], 'required'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['registerDatetime'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['email', 'authKey'], 'string', 'max' => 100],
            [['passwordHash', 'passwordResetToken'], 'string', 'max' => 200],
            [['email'], 'unique'],
            [['passwordResetToken'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '姓名',
            'email' => '邮箱',
            'authKey' => '授权秘钥',
            'passwordHash' => '加密密码',
            'passwordResetToken' => '密码重置令牌',
            'status' => '状态',
            'registerDatetime' => '注册时间',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
