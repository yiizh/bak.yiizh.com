<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;

use frontend\components\FrontendController;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class UploadController extends FrontendController
{
    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'roles' => ['@']
        ];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function trustActions()
    {
        return ['fullavatareditor'];
    }

    public function actionFullavatareditor()
    {
        $this->enableCsrfValidation = false;

        Yii::$app->response->format = Response::FORMAT_JSON;

        $file = UploadedFile::getInstanceByName('__avatar1');

        if ($file && !$file->hasError) {
            $dir = date('/Y/m/d');
            $fileName = $dir . '/' . md5(Yii::$app->security->generateRandomString()) . '.jpg';
            $realFileName = Yii::getAlias('@webroot/uploads') . $fileName;

            if (!file_exists(dirname($realFileName))) {
                mkdir(dirname($realFileName), 0777, true);
            }

            if ($file->saveAs($realFileName)) {
                $fileUrl = Yii::getAlias('@web/uploads').$fileName;
                return [
                    "success" => true,
                    "sourceUrl" => $fileUrl,
                    "avatarUrls" => [$fileUrl]
                ];
            } else {
                return [
                    'success' => false,
                    'msg' => '保存文件失败'
                ];
            }
        } else {
            return [
                'success' => false,
                'msg' => '上传失败'
            ];
        }
    }
}