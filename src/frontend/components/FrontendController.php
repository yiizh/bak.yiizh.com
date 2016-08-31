<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\components;


use yii\filters\AccessControl;
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
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => $this->accessRules()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, $this->trustActions())) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function verbs()
    {
        return [];
    }

    public function accessRules()
    {
        return [];
    }

    public function trustActions()
    {
        return [];
    }
}