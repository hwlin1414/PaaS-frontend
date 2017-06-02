<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '群組管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="groups-form row">
    
        <?php $form = ActiveForm::begin(); ?>
    
        <div class="col m5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
        </div>

        <div class="col m2">
            <p></p>
            <?= Html::submitButton('更新', ['class' => 'btn light-blue darken-2 waves-effect waves-light']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>

</div>
