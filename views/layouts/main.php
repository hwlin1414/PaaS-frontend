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
    h1 {
        font-size: 3rem;
        font-family: "微軟正黑體";
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
    <?php /*<title><?= Html::encode($this->title) ?></title>*/ ?>
    <title>中正資工 PaaS</title>
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
        $items[] = ['label' => '個人設定', 'url' => ['/self']];
        $items[] = [
            'label' => '登出 (' . Yii::$app->user->identity->name . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['class' => 'waves-effect logout', 'data-method' => 'POST'],
        ];
        if(Yii::$app->user->identity->hasPermission('layout', 'management')){
            $items[] = '<li><div class="divider"></div></li>';
            //$items[] = '<ul class="collapsible collapsible-accordion"><li>';
            //$items[] = '<a class="collapsible-header">系統管理</a>';
            //$items[] = '<div class="collapsible-body"><ul>';
            $items[] = ['label' => '虛擬平台管理', 'url' => ['/jails']];
            $items[] = ['label' => 'IP管理', 'url' => ['/ip-pools']];
            $items[] = ['label' => '帳號管理', 'url' => ['/users']];
            $items[] = ['label' => '群組管理', 'url' => ['/groups']];
            $items[] = ['label' => '系統設定', 'url' => ['/configs']];
            $items[] = ['label' => '系統紀錄', 'url' => ['/logs']];
            //$items[] = '</ul></div>';
            //$items[] = '</li></ul>';
        }
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
