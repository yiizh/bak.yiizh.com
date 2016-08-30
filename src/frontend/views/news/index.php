<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '推荐文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <div class="row">
        <div class="col-xs-9">
            <?php Panel::begin() ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'layout' => '{items} {pager}',
                'itemView' => '_view',
                'separator' => '<hr />',
            ]) ?>
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
