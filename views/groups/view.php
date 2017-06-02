<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '群組管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn light-blue darken-2 waves-effect waves-light']) ?>
        <?= Html::a('刪除',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn red lighten-1 waves-effect waves-light',
                'data-method' => 'POST',
                'data-confirm' => '您確定要刪除這筆資料?',
            ]
        ) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'group_id',
            'permission',
            [
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('刪除',
                        ['group-perms/delete', 'id' => $model->id],
                        [
                            'class' => 'btn red lighten-1 waves-effect waves-light',
                            'data-method' => 'POST',
                            'data-confirm' => '您確定要刪除這筆資料?',
                        ]
                    );
                }
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <blockquote>
        <div class="group-perms-form row">

            <?php $form = ActiveForm::begin(['action' => ['group-perms/create', 'id' => $model->id]]); ?>

            <div class="col m5">
                <?= $form->field($model_perm, 'permission')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
            </div>

            <div class="col m2">
                <p></p>
                <?= Html::submitButton('新增', ['class' => 'btn cyan darken-1 waves-effect waves-light']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </blockquote>
</div>
