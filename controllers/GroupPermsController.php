<?php

namespace app\controllers;

use Yii;
use app\filters\AccessControl;
use app\models\GroupPerms;
use app\models\search\GroupPermsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupPermsController implements the CRUD actions for GroupPerms model.
 */
class GroupPermsController extends Controller
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
     * Creates a new GroupPerms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new GroupPerms(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post())){
            $model->group_id = $id;
            if($model->save()) {
                return $this->redirect(['groups/view', 'id' => $id]);
            }
        }
        return $this->redirect(['groups/view', 'id' => $id]);
    }

    /**
     * Deletes an existing GroupPerms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id = $model->group_id;
        $model->delete();

        return $this->redirect(['groups/view', 'id' => $id]);
    }

    /**
     * Finds the GroupPerms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GroupPerms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupPerms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
