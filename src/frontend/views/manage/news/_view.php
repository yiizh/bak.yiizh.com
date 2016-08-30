<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use cebe\gravatar\Gravatar;
use common\models\News;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 * @var $user User
 */
$user = $model->user;
$formatter = Yii::$app->formatter;
?>
<div class="row news-item">
    <div class="col-xs-2 text-right">
        <p>
        <?= Gravatar::widget([
            'email' => $user->email,
            'options' => [
                'alt' => $user->name,
            ],
            'size' => 60
        ]) ?>
        </p>
    </div>
    <div class="col-xs-10">
        <div class="news-item-info">
            <p class="pull-right">
                <?= Html::a('<i class="fa fa-fw fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-fw fa-trash"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => [
                    'confirm' => '确定删除？',
                    'method' => 'post'
                ]]) ?>
            </p>
            <?= $user->name ?>
        </div>
        <div class="news-item-meta">
            <time class="text-muted"><?= $formatter->asRelativeTime($model->createdAt) ?></time>
        </div>
        <h3 class="news-item-title"><?= Html::a($model->title, ['/news/view', 'id' => $model->id]) ?></h3>
        <p class="news-item-summary"><?= HtmlPurifier::process($model->summary) ?></p>
    </div>
</div>