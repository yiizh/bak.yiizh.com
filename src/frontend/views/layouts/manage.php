<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use yii\bootstrap\Nav;
use yii\web\User;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 * @var User $user
 */

$user = Yii::$app->user;

$this->beginContent('@frontend/views/layouts/main.php');
?>
    <div class="row">
        <div class="col-xs-3">
            <?php if ($user->can('manageNews')): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">新闻管理</h3>
                    </div>
                    <?= Nav::widget([
                        'options' => [
                            'class' => 'menu list-group'
                        ],
                        'items' => [
                            [
                                'label' => News::statusLabel(News::STATUS_PROPOSED),
                                'url' => ['/manage/news/index', 'status' => News::STATUS_PROPOSED],
                            ],
                            [
                                'label' => News::statusLabel(News::STATUS_REJECTED),
                                'url' => ['/manage/news/index', 'status' => News::STATUS_REJECTED],
                            ],
                            [
                                'label' => News::statusLabel(News::STATUS_PUBLISHED),
                                'url' => ['/manage/news/index', 'status' => News::STATUS_PUBLISHED],
                            ]
                        ]
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xs-9">
            <?= $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>