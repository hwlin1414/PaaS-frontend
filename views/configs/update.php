<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Configs */

$this->title = $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->key;
?>
<div class="configs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="configs-form">
    
        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'value')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('更新', ['class' => 'btn light-blue darken-2 waves-effect waves-light']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>

</div>
