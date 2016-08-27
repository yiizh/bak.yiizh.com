<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\Alert;
use common\widgets\LoginPanel;
use yii\bootstrap\Modal;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */

$app = Yii::$app;

$this->beginContent('@frontend/views/layouts/blank.php');
?>
    <div class="wrapper">
        <?= $this->render('_header') ?>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </section>
        </div>
        <?= $this->render('_footer', [
            'app' => $app
        ]) ?>
    </div>
<?php Modal::begin([
    'id' => 'modal-default',
    'header' => '<h4 class="modal-title">操作</h4>'
]) ?>
<?php Modal::end() ?>
<?php
$this->endContent();
?>