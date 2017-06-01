<?php

namespace app\controllers;

use Yii;
use app\filters\AccessControl;
use app\models\Configs;
use app\models\search\ConfigsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfigsController implements the CRUD actions for Configs model.
 */
class ConfigsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Configs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Configs();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::warning("系統設定新增：('{$model->key}', '{$model->value}')", 'app\configs\create');
        }

        $searchModel = new ConfigsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['key' => SORT_ASC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Configs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::warning("系統設定更新：('{$model->key}', '{$model->value}')", 'app\configs\update');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Configs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Yii::warning("系統設定刪除：('{$model->key}', '{$model->value}')", 'app\configs\delete');
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Configs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Configs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Configs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
