<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%auth}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $source
 * @property string $sourceId
 */
class BaseAuth extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'source', 'sourceId'], 'required'],
            [['userId'], 'integer'],
            [['source', 'sourceId'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'source' => 'Source',
            'sourceId' => 'Source ID',
        ];
    }
}
