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

$this->title = '添加新闻';
?>
<div class="news-create">

    <?php Panel::begin([
        'title' =>$this->title
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php Panel::end() ?>

</div>
