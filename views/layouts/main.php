<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use macgyer\yii2materializecss\widgets\Nav;
use macgyer\yii2materializecss\widgets\SideNav;

AppAsset::register($this);

$this->registerCss(<<<CSS
    .side-nav {
        width: 240px;
    }
    .side-nav a {
        font-size: 16px;
    }
    @media only screen and (min-width : 992px) {
        .footer {
            margin-left: 240px;
        }
        .wrap2 > .container {
            padding-top: 0px;
            width: 90%;
        }
        .wrap2{
            padding-left: 250px;
        }
    }
CSS
);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $items = [];
    $items[] = '<li>' . Html::img('@web/images/office.jpg', ['width' => 240]) . '</li>';
    $items[] = ['label' => '首頁', 'url' => ['/']];
    $items[] = ['label' => '關於', 'url' => ['/site/about']];
    $items[] = ['label' => '虛擬平台', 'url' => ['/jails']];
    if(Yii::$app->user->isGuest){
        $items[] = ['label' => '登入', 'url' => ['/site/login']];
    }else{
        $items[] = ['label' => '個人紀錄', 'url' => ['/jails']];
        $items[] = [
            'label' => '登出 (' . Yii::$app->user->identity->name . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['class' => 'waves-effect logout', 'data-method' => 'POST'],
        ];
    }
    echo SideNav::widget([
        'options' => ['class' => 'fixed'],
        //'clientOptions' => ['menuWidth' => 240],
        'items' => $items,
    ]);
    ?>

    <div class="wrap2">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Lab401 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
