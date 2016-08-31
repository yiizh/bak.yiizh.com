<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\widgets;


use yii\web\View;
use yii\widgets\Block;

class JsBlock extends Block
{
    /**
     * @var null
     */
    public $key = null;
    /**
     * @var int
     */
    public $position = View::POS_READY;

    /**
     * Ends recording a block.
     * This method stops output buffering and saves the rendering result as a named block in the view.
     */
    public function run()
    {
        $block = ob_get_clean();
        if ($this->renderInPlace) {
            echo $block;
        }
        $block = trim($block);
        $jsBlockPattern = '|^<script[^>]*>(?P<block_content>.+?)</script>$|is';
        if (preg_match($jsBlockPattern, $block, $matches)) {
            $block = $matches['block_content'];
        }

        $this->view->registerJs($block, $this->position, $this->key);
    }
}