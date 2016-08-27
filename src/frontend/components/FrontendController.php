<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\components;


use yii\filters\VerbFilter;
use yii\web\Controller;

class FrontendController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs()
            ]
        ];
    }

    public function verbs()
    {
        return [];
    }
}