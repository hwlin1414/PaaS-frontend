<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '帳號管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            ['attribute' => 'group_id', 'value' => $model->group->name],
            'enabled:boolean',
            'amount',
            'authkey',
            'created_at',
        ],
    ]) ?>
    <p>
        <?= Html::a('刪除',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn red lighten-1 waves-effect waves-light',
                'data-method' => 'POST',
                'data-confirm' => '您確定要刪除這筆資料?',
            ]
        ) ?>
    </p>

    <blockquote>
        <div class="users-form row">

            <?php $form = ActiveForm::begin(); ?>

            <div class="col m5">
                <?= $form->field($model, 'group_id', [])->dropDownList(
                    ArrayHelper::map($groups, 'id', 'name'),
                    ['prompt' => '請選擇一個群組']
                ) ?>
            </div>

            <div class="col m5">
                <?= $form->field($model, 'amount')->textInput() ?>
            </div>

            <div class="col m5">
                <?= $form->field($model, 'enabled')->checkbox() ?>
            </div>

            <div class="col m2">
                <p></p>
                <?= Html::submitButton('更新', ['class' => 'btn light-blue darken-2 waves-effect waves-light']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </blockquote>

    <div class="logs-index">

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
                        . Html::a($model->user->name, ['users/view', 'id' => $model->user_id], ['data-pjax' => 0]);
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

</div>
