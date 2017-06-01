<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IpPools */

$this->title = 'Update Ip Pools: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ip Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ip-pools-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
