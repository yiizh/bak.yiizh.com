<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\bootstrap\Nav;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */

$this->beginContent('@frontend/views/layouts/main.php');
?>
    <div class="row">
        <div class="col-xs-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">帐号</h3>
                </div>
                <?= Nav::widget([
                    'options' => [
                        'class' => 'menu list-group'
                    ],
                    'items' => [
                        ['label' => '个人资料', 'url' => ['/account/profile']],
                        ['label' => '修改密码', 'url' => ['/account/password']],
                        ['label' => '第三方帐号绑定', 'url' => ['/openid/index']],
                    ]
                ]) ?>
            </div>
        </div>
        <div class="col-xs-9">
            <?= $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>