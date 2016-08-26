<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class Panel extends Widget
{
    public $title;

    public $options = [
        'class' => 'panel panel-default'
    ];

    public function renderHeading()
    {
        if ($this->title) {
            echo Html::beginTag('div', ['class' => 'panel-heading']);
            echo Html::tag('h3', $this->title, ['class' => 'panel-title']);
            echo Html::endTag('div');
        }
    }

    public function renderFooter()
    {

    }

    public function beginRenderBody()
    {
        echo Html::beginTag('div', ['class' => 'panel-body']);
    }

    public function endRenderBody()
    {
        echo Html::endTag('div');
    }

    public function init()
    {
        echo Html::beginTag('div', $this->options);
        $this->renderHeading();
        $this->beginRenderBody();
        $this->renderBody();
    }

    public function run()
    {
        $this->endRenderBody();
        $this->renderFooter();
        echo Html::endTag('div');
    }

    public function renderBody()
    {

    }
}