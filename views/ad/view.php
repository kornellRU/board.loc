<?php
/**
 * Created by PhpStorm.
 * User: kornell
 * Date: 01.06.18
 * Time: 1:02
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\forms\LoginForm */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="row card-view-full">
        <h2 class="col-xs-12"><?=$model->title?></h2>
        <div class="col-xs-6 img-block-ad">
            <?php foreach ($model->images as $k => $img): ?>
                <span class="img-path-view-block <?= ($k == 0)?'first-img-view-ad':''?>">
        <?= Html::img('@web/images/uploads/ads/'.$img['path'], []) ?>
                </span>
            <?php endforeach ?>
        </div>
        <div class="col-xs-6">
            <div class="author-ad">
                Добавил: <a href="<?= Url::to(['/profile/default/index', 'id' => $model->author['id'], 'name' => $model->author['username']]) ?>"><?=$model->author['username']?></a>
            </div>
            <div class="date-created-ad">Добавлен: <?= Yii::$app->formatter->asDate($model->created_at)?></div>
            <div class="price-ad"><em>Цена:</em> <?=$model->price?> грн.</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?=$model->body?>
        </div>

    </div>
</div>