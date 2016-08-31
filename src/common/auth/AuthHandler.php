<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */


namespace common\auth;

use common\models\Auth;
use common\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handleWeibo()
    {
        $attributes = $this->client->getUserAttributes();
        $id = ArrayHelper::getValue($attributes, 'id');
        $nickname = ArrayHelper::getValue($attributes, 'screen_name');

        /* @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'sourceId' => $id,
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // 登录
                /* @var User $user */
                $user = $auth->user;
                $this->updateUserInfo($user);
                Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
            } else { // 注册
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app', '你的微博尚未绑定，请先注册或登录 {login}', [
                        'login' => Html::a('立即登录', ['/login/index', 'authclient' => $this->client->getId()], [
                            'class' => 'btn btn-success'
                        ])
                    ]),
                ]);
                return Yii::$app->response->redirect(['/register/index', 'authclient' => $this->client->getId()]);
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'userId' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'sourceId' => (string)$attributes['id'],
                ]);
                if ($auth->save()) {
                    /** @var User $user */
                    $user = $auth->user;
                    $this->updateUserInfo($user);
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', '已绑定 {client} 账号.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        '绑定 {client} 帐号失败. 已绑定其他帐号.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }

    public function handle()
    {
        switch ($this->client->getId()) {
            case 'weibo':
                $this->handleWeibo();
                break;
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $attributes = $this->client->getUserAttributes();
        $weibo = ArrayHelper::getValue($attributes, 'id');
        if ($user->weibo == null && $weibo) {
            $user->weibo = (string)$weibo;
            $user->save();
        }
    }
}