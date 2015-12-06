<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

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
    NavBar::begin([
        'brandLabel' => Yii::$app->id,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Assortment', 'items' => [
                ['label' => 'Categories', 'url' => ['/category']],
                ['label' => 'Products', 'url' => ['/product']],
            ]],
            ['label' => 'People', 'items' => [
                ['label' => 'Customers', 'url' => ['/customer']],
                ['label' => 'Customer Demographics', 'url' => ['/customer-demographic']],
                ['label' => 'Employees', 'url' => ['/employee']],
            ]],
            ['label' => 'Orders', 'items' => [
                ['label' => 'Orders', 'url' => ['/order']],
                ['label' => 'Order Details', 'url' => ['/order-detail']],
                ['label' => 'Suppliers', 'url' => ['/supplier']],
            ]],
            ['label' => 'Transport', 'items' => [
                ['label' => 'Shippers', 'url' => ['/shipper']],
                ['label' => 'Regions', 'url' => ['/region']],
                ['label' => 'Territories', 'url' => ['/territory']],
            ]],
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => Yii::t('app', 'Login'),
                'url' => ['/usr/login'],
                'visible' => Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('app', 'Logout').' ('
                . (Yii::$app->user->identity === null ? '' : Yii::$app->user->identity->username) . ')',
                'url' => ['/usr/logout'],
                'visible' => !Yii::$app->user->isGuest,
                'linkOptions' => ['data-method' => 'post'],
            ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div id="menu" class="hidden-print">
            <?= \yii\bootstrap\Nav::widget([
                'items' => isset($this->params['menu']) ? $this->params['menu'] : [],
                'options' => ['class' => 'nav nav-pills'],
            ]) ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->id . ' ' . date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
