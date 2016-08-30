<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use common\models\User;
use common\widgets\Alert;
use frontend\components\FrontendController;
use frontend\forms\ChangePasswordForm;

class AccountController extends FrontendController
{
    public $layout = 'profile';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['@']
            ]
        ];
    }

    /**
     * 帐号首页
     *
     * @return string
     */
    public function actionProfile()
    {
        /**
         * @var $model User
         */
        $model = \Yii::$app->user->getIdentity();
        $model->setScenario(User::SCENARIO_PROFILE);

        if ($model->load(\Yii::$app->request->post()) && $model->saveProfile()) {
            Alert::set('success', '保存个人资料成功');
            return $this->refresh();
        }

        return $this->render('profile', [
            'model' => $model
        ]);
    }

    public function actionPassword()
    {
        /**
         * @var $user User
         */
        $user = \Yii::$app->user->getIdentity();

        $model = new ChangePasswordForm($user);

        if ($model->load(\Yii::$app->request->post()) && $model->changePassword()) {
            Alert::set('success', '密码修改成功，下次登录请使用新的密码.');
            return $this->refresh();
        }

        return $this->render('password', [
            'model' => $model
        ]);
    }
}