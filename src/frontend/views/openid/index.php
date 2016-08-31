<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\User;
use common\widgets\Panel;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $user User
 */

$this->title = '第三方帐号绑定';

$hasBindWeibo = $user->hasBind('weibo');
?>
<div class="openid-index">
    <?php Panel::begin([
        'title' => $this->title
    ]) ?>

    <p class="text-muted">
        绑定第三方帐号，可以让您快速、便捷的登录。
    </p>

    <table class="table table-bordered">
        <colgroup>
            <col style="width: 180px;">
            <col>
            <col style="width: 100px;">
        </colgroup>
        <tr>
            <th>第三方平台</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td>
                <?= Html::img('@web/static/images/weibo.png') ?>
                <span style="margin-left: 15px;">新浪微博</span>
            </td>
            <td>
                <?php if ($hasBindWeibo): ?>
                    <span class="label label-success">已绑定</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($user->hasBind('weibo')): ?>
                    <?= Html::a('解除绑定', ['unbind', 'authclient' => 'weibo'], ['class' => 'btn btn-sm btn-danger', 'data' => [
                        'method' => 'post',
                        'confirm' => '确定解除绑定？'
                    ]]) ?>
                <?php else: ?>
                    <?= Html::a('绑定', ['/site/auth', 'authclient' => 'weibo'], ['class' => 'btn btn-sm btn-success']) ?>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php Panel::end() ?>
</div>
