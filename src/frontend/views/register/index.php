<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use frontend\forms\RegisterForm;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var RegisterForm $model
 */
$this->title = '注册';
?>
<div class="register-index">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <?= $this->title ?>
                    </h4>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-register']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className()) ?>

                    <div class="form-group">
                        <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                    </div>

                    <p>
                        已有帐号？ <?=Html::a('立即登录',Yii::$app->user->loginUrl)?>
                    </p>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
