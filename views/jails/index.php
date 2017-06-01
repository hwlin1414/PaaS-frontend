<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\JailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jails-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jails', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'hostname',
            'ip',
            'quota',
            // 'enabled',
            // 'enabledby',
            // 'description',
            // 'sshkey',
            // 'created_at',
            // 'enabled_at',
            // 'expired_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
