<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\models\User;
use console\components\ConsoleController;
use Yii;
use yii\base\InvalidParamException;

class RbacController extends ConsoleController
{
    /**
     * 重建权限树
     *
     * @return int
     */
    public function actionInit()
    {
        if (!$this->confirm("确定重建权限树?")) {
            return self::EXIT_CODE_NORMAL;
        }
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $manageNews = $auth->createPermission('manageNews');
        $manageNews->description = 'Manage news';
        $auth->add($manageNews);

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Manage users';
        $auth->add($manageUsers);

        $admin = $auth->createRole('admin');
        $admin->description = '管理员';

        $auth->add($admin);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $manageNews);
    }

    /**
     * 为用户赋权限
     *
     * @param string $role
     * @param string $email
     */
    public function actionAssign($role, $email)
    {
        $user = User::findByEmail($email);
        if (!$user) {
            throw new InvalidParamException("邮箱为 \"$email\" 的用户不存在.");
        }
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);
        if (!$role) {
            throw new InvalidParamException("角色 \"$role\" 不存在.");
        }
        $auth->assign($role, $user->id);
    }
}