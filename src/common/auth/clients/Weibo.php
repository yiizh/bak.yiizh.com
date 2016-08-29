<?php
/**
 * @author Alex Zhang <alex@extong.net>
 */
/**
 * @link http://honeycomb.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://honeycomb.yiizh.com/license/
 */


namespace common\auth\clients;


use yii\authclient\OAuth2;

class Weibo extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://api.weibo.com/oauth2/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.weibo.com/oauth2/access_token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.weibo.com/2';

    public function init()
    {
        parent::init();
    }

    protected function initUserAttributes()
    {
        $uid = $this->api('account/get_uid.json', 'GET');
        $attributes = $this->api('users/show.json', 'GET', $uid);

        return $attributes;
    }

}