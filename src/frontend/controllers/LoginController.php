<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;

use frontend\components\FrontendController;
use frontend\forms\LoginForm;
use Yii;

class LoginController extends FrontendController
{
    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['?']
            ]
        ];
    }

    /**
     * @param string|null $authclient
     * @return string|\yii\web\Response
     */
    public function actionIndex($authclient = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($authclient != null) {
                return $this->redirect(['/site/auth', 'authclient' => $authclient]);
            }
            return $this->goBack();
        } else {
            return $this->render('index', [
                'model' => $model,
                'authclient' => $authclient
            ]);
        }
    }
}