<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\Panel;
use frontend\forms\ChangePasswordForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model ChangePasswordForm
 */

$this->title = '修改密码';
?>
<div class="account-password">
    <?php Panel::begin([
        'title' => $this->title
    ]) ?>
    <div class="row">
        <div class="col-xs-6">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'oldPassword')->passwordInput(['placeholder' => '请输入旧密码']) ?>

            <?= $form->field($model, 'newPassword')->passwordInput(['placeholder' => '请输入新密码']) ?>

            <?= $form->field($model, 'rePassword')->passwordInput(['placeholder' => '请输入重复密码']) ?>

            <div class="form-group">
                <?= Html::submitButton('修改密码', ['class' => 'btn btn-danger']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
</div>
