<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use cebe\gravatar\Gravatar;
use common\models\News;
use common\models\User;
use common\widgets\Panel;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 * @var $user User
 */

$this->title = $model->title;
$user = $model->user;
$formatter = Yii::$app->formatter;
?>
<div class="news-view">
    <div class="row">
        <div class="col-xs-9">
            <?php Panel::begin() ?>
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
                    <div class="news-item-info"><?= $user->name ?></div>
                    <div class="news-item-meta">
                        <time class="text-muted"><?= $formatter->asRelativeTime($model->createdAt) ?></time>
                    </div>
                    <h3 class="news-item-title"><?= $model->title ?></h3>
                    <p class="news-item-summary"><?= HtmlPurifier::process($model->summary) ?></p>
                    <p><?= Html::a($model->link, $model->link, ['target' => '_blank']) ?></p>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-xs-3">
            <div class="well">
                <p>好文章，要分享。</p>
                <p>
                    <?= Html::a('推荐文章', ['/news/suggest'], ['class' => 'btn btn-block btn-success']) ?>
                </p>
            </div>
        </div>
    </div>
</div>
