<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use common\auth\AuthHandler;
use frontend\components\FrontendController;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\captcha\CaptchaAction;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends FrontendController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
            'auth' => [
                'class' => AuthAction::className(),
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'captcha' => [
                'class' => CaptchaAction::className(),
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function verbs()
    {
        return [
            'logout' => ['post']
        ];
    }

    /**
     * @param ClientInterface $client
     */
    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
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