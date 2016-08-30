<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\widgets\Panel;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 */

$this->title = '推荐';
?>
<div class="news-suggest">
    <?php Panel::begin([
        'title' => $this->title
    ]) ?>

    <?php $form = ActiveForm::begin(['id' => 'news-add']) ?>

    <?= $form->field($model, 'link') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'summary')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

    <?php Panel::end() ?>
</div>
