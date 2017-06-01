<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\IpPools */

$this->title = 'Create Ip Pools';
$this->params['breadcrumbs'][] = ['label' => 'Ip Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ip-pools-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
