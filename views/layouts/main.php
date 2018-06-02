<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],

    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
Yii::$app->user->isGuest ?
                ['label' => 'Войти', 'url' => ['/login']] :
                [
                    'label' =>Yii::$app->user->identity->username.''. Html::img(Yii::$app->user->identity->photo?'/images/users/'.Yii::$app->user->identity->photo:'/images/system/no-image.png', ['class' => 'menu-avatar', 'style' => 'max-width:30px; border-radius:50%; border:1px solid #fff; background-color:#fff; margin-left: 5px;']),
                    'items' => [
    \Yii::$app->user->can('administrator')?['label' => 'Разрешения', 'url' => '/user/rbac']:'',
    \Yii::$app->user->can('administrator')?['label' => 'Пользователи', 'url' => '/admin']:'',
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Профиль</li>',
                        ['label' => 'Профиль', 'url' => '/profile/'],
                        ['label' => 'Настройки', 'url' => '/profile/setting'],
                        ['label' => 'Ваши объявления', 'url' => '/profile/ad'],
                        ['label' => 'Добавить объявление', 'url' => '/profile/ad/create'],
                        '<li class="divider"></li>',
//
                        ['label' => 'Выйти',
                            'url' => ['/logout'],
                            'linkOptions' => ['data-method' => 'post']],

                    ],
                ],
['label' => 'Регистрация', 'url' => ['/signup'], 'visible' => Yii::$app->user->isGuest],
                    ],
//        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
