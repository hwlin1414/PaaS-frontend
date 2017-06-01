<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ConfigsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系統設定';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'key',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(Html::encode($model->key), ['update', 'id' => $model->id]);
                }
            ],
            'value',
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
        <div class="configs-form row">
        
            <?php $form = ActiveForm::begin(); ?>

            <div class="col m5">
                <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col m5">
                <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
            </div>
        
            <div class="col m2">
                <p></p>
                <?= Html::submitButton('新增', ['class' => 'btn cyan darken-1 waves-effect waves-light']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        
        </div>
    </blockquote>
</div>
