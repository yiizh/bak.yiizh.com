<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */


namespace frontend\controllers;

use frontend\components\FrontendController;
use frontend\forms\RegisterForm;
use Yii;

class RegisterController extends FrontendController
{
    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['?', '@']
            ]
        ];
    }

    public function actionIndex($authclient = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                if (Yii::$app->getUser()->login($user)) {
                    if ($authclient != null) {
                        return $this->redirect(['/site/auth', 'authclient' => $authclient]);
                    }
                    return $this->goHome();
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
            'authclient'=>$authclient
        ]);
    }
}