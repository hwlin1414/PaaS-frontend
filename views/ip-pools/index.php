<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\IpPoolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ip Pools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ip-pools-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'ip',
            'host',
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
        <div class="ip-pools-form row">
        
            <?php $form = ActiveForm::begin(); ?>
        
            <div class="col m5">
                <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col m5">
                <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>
            </div>
        
            <div class="col m2">
                <p></p>
                <?= Html::submitButton('新增', ['class' => 'btn cyan darken-1 waves-effect waves-light']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        
        </div>
    </blockquote>
</div>
