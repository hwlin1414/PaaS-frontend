<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupPerms */

$this->title = 'Create Group Perms';
$this->params['breadcrumbs'][] = ['label' => 'Group Perms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-perms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
