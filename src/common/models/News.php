<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * @property User $user
 */
class News extends BaseNews
{
    const STATUS_PROPOSED = 1;
    const STATUS_PUBLISHED = 10;
    const STATUS_REJECTED = 0;

    const SCENARIO_SUGGEST = 'suggest';
    const SCENARIO_UPDATE = 'update';

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SUGGEST] = ['title', 'summary', 'link'];
        $scenarios[self::SCENARIO_UPDATE] = ['title', 'summary', 'link', 'status'];
        return $scenarios;
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return static::statusLabel($this->status);
    }

    /**
     * @param int $status
     * @return string
     */
    public static function statusLabel($status)
    {
        $statuses = static::getStatusItems();
        return ArrayHelper::getValue($statuses, $status);
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_PROPOSED => '投稿',
            self::STATUS_PUBLISHED => '发布',
            self::STATUS_REJECTED => '拒绝',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
