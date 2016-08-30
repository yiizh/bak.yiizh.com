<?php

namespace frontend\controllers;

use common\models\News;
use common\widgets\Alert;
use frontend\components\FrontendController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 */
class NewsController extends FrontendController
{
    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'actions' => ['index', 'view'],
        ];

        $rules[] = [
            'allow' => true,
            'actions' => ['update', 'delete', 'admin'],
            'roles' => ['manageNews']
        ];

        $rules[] = [
            'allow' => true,
            'actions' => ['suggest'],
            'roles' => ['@']
        ];


        return $rules;
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->andWhere(['status' => News::STATUS_PUBLISHED])->orderBy('createdAt DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->status != News::STATUS_PUBLISHED && !Yii::$app->user->can('manageNews')) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * 推荐
     *
     * @return mixed
     */
    public function actionSuggest()
    {
        $model = new News([
            'status' => News::STATUS_PROPOSED,
            'scenario' => News::SCENARIO_SUGGEST
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->userId = Yii::$app->user->id;
            if ($model->save(false)) {
                Alert::set('success', '推荐成功');
                return $this->redirect(['index']);
            }
        }

        return $this->render('suggest', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
