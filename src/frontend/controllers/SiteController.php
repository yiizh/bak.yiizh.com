<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use frontend\components\FrontendController;
use yii\web\ErrorAction;

class SiteController extends FrontendController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}