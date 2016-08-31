<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\widgets\Panel;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var View $this
 * @var int $status
 * @var ActiveDataProvider $dataProvider
 */

$this->title = '新闻管理 ';
?>
<div class="manage-news-index">
    <?php Panel::begin([
        'title' => News::statusLabel($status) . '的新闻'
    ]) ?>

    <p>
        <?= Html::a('添加新闻', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}',
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_view',
        'separator' => '<hr />',
    ]) ?>

    <?php Panel::end() ?>
</div>
