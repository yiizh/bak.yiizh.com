<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */
use frontend\forms\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model LoginForm
 */

$this->title = '登录';
?>
<div class="login-index">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <?= $this->title ?>
                    </h4>
                </div>
                <div class="panel-body">

                    <?php $form = ActiveForm::begin() ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => '邮箱'])->label(false) ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => '密码'])->label(false) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('登录', ['class' => 'btn btn-block btn-primary']) ?>
                    </div>

                    <p>
                        还没有帐号？<?= Html::a('立即注册', ['/register/index']) ?>
                    </p>
                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>
</div>