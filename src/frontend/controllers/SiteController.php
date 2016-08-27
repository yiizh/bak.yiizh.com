<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use frontend\components\FrontendController;
use yii\web\ErrorAction;
use yii\web\Response;

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

    public function verbs()
    {
        return [
            'logout' => ['post']
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 退出登录
     *
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(\Yii::$app->homeUrl);
    }
}