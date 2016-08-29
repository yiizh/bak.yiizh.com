<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model User
 */

$this->title = '个人资料';
?>
<div class="account-profile">
    <div class="row">
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('保存个人资料', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
