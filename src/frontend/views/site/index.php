<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 */

$this->title = '首页';
?>
<div class="site-index">
    <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6"></div>
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
