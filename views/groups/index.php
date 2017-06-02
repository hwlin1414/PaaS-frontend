<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '群組管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id], ['data-pjax' => '0']);
                },
            ],
            [
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('刪除',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn red lighten-1 waves-effect waves-light',
                            'data-method' => 'POST',
                            'data-confirm' => '您確定要刪除這筆資料?',
                        ]
                    );
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <blockquote>
        <div class="groups-form row">
        
            <?php $form = ActiveForm::begin(); ?>
        
            <div class="col m5">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        
            <div class="col m2">
                <p></p>
                <?= Html::submitButton('新增', ['class' => 'btn cyan darken-1 waves-effect waves-light']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        
        </div>
    </blockquote>
</div>
