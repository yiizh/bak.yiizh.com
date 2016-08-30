<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\widgets\Panel;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 */

$this->title = '修改 ' . $model->title;
?>
<div class="news-update">

    <?php Panel::begin([
        'title' => '修改'
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php Panel::end() ?>

</div>
