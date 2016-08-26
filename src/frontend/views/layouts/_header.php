<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/**
 */
$user = Yii::$app->user;

$mainItems = [
    ['label' => '首页', 'url' => Yii::$app->homeUrl],
];

$rightNavItems = [];

if ($user->isGuest) {
    $rightNavItems[] = ['label' => '登录', 'url' => ['/login/index']];
    $rightNavItems[] = ['label' => '注册', 'url' => ['/register/index']];
} else {
    $rightNavItems[] = ['label' => '退出', 'url' => ['/site/logout'], ['data' => ['method' => 'post']]];
}

?>
<header class="main-header">
    <?php NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-static-top'
        ],
        'brandLabel' => Html::img('@web/static/images/brand-logo.png')
    ]); ?>
    <div class="navbar-left">
        <?= Nav::widget([
            'options' => [
                'class' => 'navbar-nav'
            ],
            'items' => $mainItems
        ]) ?>
    </div>

    <div class="navbar-right">
        <?= Nav::widget([
            'options' => [
                'class' => 'navbar-nav'
            ],
            'encodeLabels' => false,
            'items' => $rightNavItems
        ]) ?>
    </div>
    <?php NavBar::end() ?>
</header>
