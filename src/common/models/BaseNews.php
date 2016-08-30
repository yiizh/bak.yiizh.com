<?php

namespace common\models;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property string $summary
 * @property string $link
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseNews extends \common\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'status', 'createdAt', 'updatedAt'], 'integer'],
            [['title', 'summary', 'link'], 'required'],
            [['title'], 'string', 'max' => 100],
            [['summary'], 'string', 'max' => 500],
            [['link'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => '用户 ID',
            'title' => '标题',
            'summary' => '摘要',
            'link' => '链接地址',
            'status' => '状态',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
