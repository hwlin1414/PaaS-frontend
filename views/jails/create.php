<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jails */

$this->title = 'Create Jails';
$this->params['breadcrumbs'][] = ['label' => 'Jails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
