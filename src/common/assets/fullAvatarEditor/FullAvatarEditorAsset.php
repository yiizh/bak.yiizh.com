<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\assets\fullAvatarEditor;

use yii\web\AssetBundle;

class FullAvatarEditorAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/fullAvatarEditor/assets';

    public $js = [
        'scripts/swfobject.js',
        'scripts/fullAvatarEditor.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

}