<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'static/css/site.css'
    ];

    public $js = [
        'static/js/site.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yiizh\adminlte\AdminLTEAsset',
        'yiizh\adminlte\AdminLTEBlueAsset',
        'yiizh\fontawesome\FontAwesomeAsset',
    ];
}