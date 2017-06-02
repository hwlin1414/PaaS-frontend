<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '帳號管理';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(<<<JS
$('select').material_select();
$(document).on('pjax:success', function() {
    $('select').material_select();
})
JS
);
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            $class = "";
            if($model->enabled == 0){
                $class = "grey lighten-2";
            }
            return ['class' => $class];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id], ['data-pjax' => 0]);
                },
            ],
            'amount',
            [
                'attribute' => 'group_id',
                'format' => 'raw',
                'value' => function($model){
                    $group = $model->group;
                    return Html::a(Html::encode($group->name), ['groups/view', 'id' => $group->id], ['data-pjax' => 0]);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'group_id',
                    ArrayHelper::map($groups, 'id', 'name'),
                    ['class'=>'','prompt' => '']
                ),
            ],
            'enabled:boolean',
            // 'authkey',
            'created_at',
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
