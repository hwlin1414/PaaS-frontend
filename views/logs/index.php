<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系統紀錄';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            $class = "";
            switch($model->level){
                case 'error':
                    $class = "deep-orange lighten-4";
                    break;
                case 'warning':
                    $class = "amber lighten-4";
                    break;
            }
            return ['class' => $class];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ip',
            'level',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($model){
                    if($model->user_id == null){
                        return null;
                    }
                    return "({$model->user_id}) "
                        . Html::a($model->user->name, ['users/view', 'id' => $model->user_id]);
                }
            ],
            'description',
            'action',
            'created_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
